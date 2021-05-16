<?php 


declare(strict_types=1);

namespace System\Controller;
 
use Laminas\Db\Adapter\Adapter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use System\Form\Privilege\PrivilegeForm;
use System\Model\Table\AccessModeTable;
use System\Model\Table\AccessModulesTable;
use System\Model\Table\AccessPrivilegesTable;
use System\Model\Table\AccessResourcesTable;
use System\Model\Table\AccessRoleModuleTable;
use System\Model\Table\AccessRolesTable; 

class PrivilegeController extends AbstractActionController
{

 
	private $adapter;    # database adapter

	public function __construct(Adapter $adapter)
	{ 
	    $this->adapter=$adapter;
	}

 	
	/**
	 * indexAction : Liste de tout les  préviléges avec les ressources alloué pour tout les role 
	 *
	 * @return void
	 */
	public function indexAction()
	{
        $RoleTable=new AccessRolesTable($this->adapter);
		$Listedroits=$RoleTable->getAllPrivilagesRole(true);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$Listedroits->setCurrentPageNumber($page);
		$Listedroits->setItemCountPerPage(5);


		$this->layout()->setTemplate('system/layout');
		return (new ViewModel(['ListeRessources' => $Listedroits]))->setTemplate('system/lister-droit');
    }
    
    /**
     * editAction
     * Listes tout les Module avec tout les mode associé pour les ajouter a des role
     * @return void
     */
    public function editAction(){
        

		$AccessMode=new AccessModeTable($this->adapter);
		$AccessModeRecord=$AccessMode->select();
		$ListeMode=[];
		foreach($AccessModeRecord as $p){
			$ListeMode[$p->idaccessmode]=$p->labelaccessmode;
		}

        $AccessModules=new AccessModulesTable($this->adapter);
		$AccessModulesRecord=$AccessModules->select(); 

		$roleParam=$this->params()->fromRoute("role");

		$RoleModuleTableTable=new AccessRoleModuleTable($this->adapter);
		$ModuleRoles=$RoleModuleTableTable->select([
			"role_id"=>$roleParam 
		]);

		$ListeDesModuleAffected=[];
 
		foreach($ModuleRoles as $ModuleRole){
			$ListeDesModuleAffected[$ModuleRole['access_module_id'].'_'.$ModuleRole['idaccessmode']]=$ModuleRole['access_module_id'];
		}	

		$view=new ViewModel(['role'=>$roleParam,'asseigned'=>$ListeDesModuleAffected,'ListeMode' => $ListeMode,'ListeModules'=>$AccessModulesRecord]);
		$view->setTerminal(true);	 
		return $view->setTemplate('system/add-droit');
        
    }
  	 
	 /**
	  * assigneDroitAction
	  * Afficher les droit et assignier 
	  * @return void
	  */
	 public function assigneDroitAction(){
		$ressourceTable=new AccessResourcesTable($this->adapter);
		
		$PrivilegeTable=new AccessPrivilegesTable($this->adapter); 

		$roleParam=$this->params()->fromRoute("role");
		$moduleParam=$this->params()->fromRoute("module");

		$ListeRessources=$ressourceTable->fetchAllReressource(true,$moduleParam);
		$Privilege=$PrivilegeTable->fetchResourcesByRole($roleParam,$moduleParam);

		$droitassigned=[];
		foreach($Privilege as $p){
			$droitassigned[$p['resource_id']]=$p['action'];
		}
		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeRessources->setCurrentPageNumber($page);
		$ListeRessources->setItemCountPerPage(5);
		$view =    new   ViewModel(['ListeRessources' => $ListeRessources,"role_id"=>$roleParam,"module_id"=>$moduleParam,"asseigned"=>$droitassigned]);
        $view->setTerminal(true);
		return  $view->setTemplate('system/assigne-droit');
	 }

		 
	 /**
	  * updatePrivilegeAction
	  *Assignier les droit
	  * @return void
	  */
	 public function updatePrivilegeAction(){
		$PrivilegeTable=new AccessPrivilegesTable($this->adapter);
		$view =    new   ViewModel();
		if($this->getRequest()->isPost()) {
			try{
				$role=$this->params()->fromPost('role',null);
				$ressource=$this->params()->fromPost('ressource',null);
				$check=$this->params()->fromPost('check',null);
				$data=["role_id"=>$role,"resource_id"=>$ressource];
				if($check=="true"){
					$PrivilegeTable->insert($data);	
				}else{
					$PrivilegeTable->delete($data);
				}
				echo "OK";
			} catch (\Exception $e){
				 $e->getMessage() ; 
			}
		}
		$view->setTerminal(true);
		return  $view->setTemplate('system/update-privilege');
	 }
 
	 
	 /**
	  * assignerModuleAction
	  *	Assigner un module a un role : l'affection s'effectu par mode (Administration, envoi des mail, consultation, impresion...)
	  * les ressources a un rôle
	  * 
	  * @return void
	  */
	 public function assignerModeModuleAction(){
		$RoleModuleTableTable=new AccessRoleModuleTable($this->adapter);
		$PrivilegeTable=new AccessPrivilegesTable($this->adapter);
		$RessourceTable = new AccessResourcesTable($this->adapter);
		$view =    new   ViewModel();
		 if($this->getRequest()->isPost()) {
			try{

				$role=$this->params()->fromPost('role',null);
				$module=$this->params()->fromPost('module',null);
				$mode=$this->params()->fromPost('mode',null); 
				$check=$this->params()->fromPost('check',null);
				$data=[
					"role_id"=>$role
					,"access_module_id"=>$module
					,'idaccessmode'=>$mode 
				];
				 
				$Ressources=$RessourceTable->select(['idaccessmodules'=>$module,'idaccessmode'=>$mode]);
				 
				if($check=="true"){
					$RoleModuleTableTable->insert($data);

					foreach($Ressources as $r){
					 
						$dataR=["role_id"=>$role,"resource_id"=>$r["resource_id"]];
						$PrivilegeTable->insert($dataR);
					}  
				}elseif($check=="false"){
					$RoleModuleTableTable->delete($data);
					foreach($Ressources as $r){
						$dataR=["role_id"=>$role,"resource_id"=>$r["resource_id"]];
						$PrivilegeTable->delete($dataR);
					} 
				}
				echo "OK";
			} catch (\Exception $e){
				 $e->getMessage() ; 
			}
		} 
		$view->setTerminal(true);
		return  $view->setTemplate('system/update-privilege');
	 }

 
}