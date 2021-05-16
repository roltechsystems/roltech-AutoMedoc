<?php 


declare(strict_types=1);

namespace System\Controller;
 
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Select;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Filter\File\Rename; 
use System\Model\Table\AccessModulesTable; 
use System\Model\Table\AccessRolesTable;
use Limostr\Tools\Template; 

use Laminas\View\Model\JsonModel;
use RuntimeException;
use System\Form\Roles\RoleForm;
use System\Model\Table\AccessPrivilegesTable;
use System\Model\Table\AccessRoleModuleTable;

class RolesController extends AbstractActionController
{

 
	private $adapter;    # database adapter

	public function __construct(Adapter $adapter)
	{ 
	    $this->adapter=$adapter;
	}

	public function treeRoleAction(){
		
		$RoleTable= new AccessRolesTable($this->adapter);
    	$ModuleTable= new AccessModulesTable($this->adapter);
    	 
    	$listeRole=$RoleTable->Select();
		$ListeModule=$ModuleTable->select();
    	$RoleTree=[];
		$NodeModule=[];
		 
		foreach($ListeModule as $module){
			$NodeModule[]= Template::NodeReturn("Module_".$module->access_module_id,$module->module_name,$module->module_name,"","false",[]); 
		}
    	foreach ($listeRole as  $role){ 
			$NodeModuleTmp=$NodeModule;
			foreach($NodeModuleTmp as $key => $module){
				$NodeModuleTmp[$key]['key']=$NodeModuleTmp[$key]['key']."_Role_".$role->role_id; 
			}
       		$NodeRole= Template::NodeReturn("Role_".$role->role_id,$role->role_name,$role->role_name,"","true",$NodeModuleTmp); 
			$RoleTree[]=$NodeRole; 
    	}
		 
		$Note[]=Template::NodeReturn("Roles_Root","Liste des Roles","Liste des roles gérer dans SmartUniversity","","true",$RoleTree);
	  
		 $JsonModel =new JsonModel(array(
            "data"=>$Note,
        ));

		$JsonModel->setTerminal(true);
	 	return $JsonModel;

	}

	public function gestionRoleAction(){ 
 		$this->layout()->setTemplate('system/layout');
		return (new ViewModel([]))->setTemplate('system/tree-role-management');
	}
		
	
	public function menuGestionRoleAction()
	{
		return (new ViewModel([]))->setTemplate('system/menu-role-management');
	}
	/**
	 * indexAction Mode d'accées consultation
	 * 
	 * @return void
	 */
	public function indexAction()
	{
        $RoleTable=new AccessRolesTable($this->adapter);
		$ListeRole=$RoleTable->getAllRoles();

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeRole->setCurrentPageNumber($page);
		$ListeRole->setItemCountPerPage(5);

		$view =  new ViewModel(['ListeRole' => $ListeRole]) ;
		$view->setTerminal(true);
		return $view->setTemplate('system/lister-role');
    }

    public function editAction(){
        $RoleForm = new RoleForm($this->adapter);  
		
		$view =  new ViewModel(['form' => $RoleForm]);
        $view->setTerminal(true);	 
		return $view->setTemplate('system/add-role');
        
    }
	
	/**
	 * saveRoleAction
	 *	Enregistrer un nouveau role
	 * @return void
	 */
	public function saveRoleAction(){
		$request = $this->getRequest(); 
	    if($request->isPost()) { 
			$RoleForm = new RoleForm($this->adapter);  
			$RoleTable=new AccessRolesTable($this->adapter);
	    	$formData = $request->getPost()->toArray();
	    	//$RessourcesForm->setInputFilter($ressourceTable->getRessourcesFormFilter());
	    	$RoleForm->setData($formData);

	    	if($RoleForm->isValid()) {
	    		try {
					$data = $RoleForm->getData();
					//$dataInsert['resource_id']=$data;
					$dataInsert['role_name']=$data['role_name'];
					$dataInsert['role_descrept']=$data['role_descrept']; 
					$dataInsert['role_id']=$data['role_id'];  
	    			$RoleTable->insert($dataInsert); 
					$viewModel =new JsonModel( ['data' => ['status'=>'success','message'=>'Un nouveau module ajouter']]);

					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('communjson/json-view'); 
	    			//$this->flashMessenger()->addSuccessMessage('Nouveau ressources ajouter, pré à étre assigner a des utilisateur'); 
	    			//return $this->redirect()->toRoute('roles');
	    		} catch(RuntimeException $exception) {
					$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
			
					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('communjson/json-view'); 
	    		}
	    	}
	    }  
       
	}
	
	/**
	 * deleteRoleAction
	 *	Supprimer un role : la suppression engendre un ensemble de suppression en paralelle 
	 * @return void
	 */
	public function deleteRoleAction(){
		$request = $this->getRequest(); 
		$RoleTable=new AccessRolesTable($this->adapter);
		$PrivilegesTable=new AccessPrivilegesTable($this->adapter);
		$UsersTable = new \User\Model\Table\UsersTable($this->adapter);
		$RoleModuleTable= new AccessRoleModuleTable($this->adapter);

		try {
			$this->adapter->getDriver()->getConnection()->beginTransaction();

			$role_id=$this->params()->fromRoute("id");
			$RoleModuleTable->delete(["role_id"=>$role_id]);
			$UsersTable->update(["role_id"=>NULL],["role_id"=>$role_id]);
			$PrivilegesTable->delete(["role_id"=>$role_id]);
			$RoleTable->delete(["role_id"=>$role_id]); 
			

			$viewModel =new JsonModel( ['data' => ['status'=>'success','message'=>'Un nouveau module ajouter']]);

			$this->adapter->getDriver()->getConnection()->commit();
			$viewModel->setTerminal(true);
			return $viewModel->setTemplate('communjson/json-view'); 
			//$this->flashMessenger()->addSuccessMessage('Nouveau ressources ajouter, pré à étre assigner a des utilisateur'); 
			//return $this->redirect()->toRoute('roles');
		} catch(RuntimeException $exception) {
			$this->adapter->getDriver()->getConnection()->rollback();
			$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
	
			$viewModel->setTerminal(true);
			return $viewModel->setTemplate('communjson/json-view'); 
		}
	}



 
}