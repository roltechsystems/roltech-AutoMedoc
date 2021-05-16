<?php 


declare(strict_types=1);

namespace System\Controller;
 
use Laminas\Db\Adapter\Adapter; 
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use System\Model\Table\AccessModulesTable;  
use Limostr\Tools\Template; 

use Laminas\View\Model\JsonModel;
use RuntimeException;
use System\Form\Menu\MenuForm; 
use System\Model\Table\AccessMenuTable; 

class MenuController extends AbstractActionController
{

	private $adapter;    # database adapter

	public function __construct(Adapter $adapter)
	{ 
	    $this->adapter=$adapter;
	}
	private function createTreeModuleMenu(){
		$ModuleTable=new AccessModulesTable($this->adapter);
		$ModuleRecords=$ModuleTable->select();
		if($ModuleRecords){
			foreach($ModuleRecords as $ModuleRecord){
				$NodesMenu=[];
				$this->CreateTreeMenu($NodesMenu,$ModuleRecord->access_module_id);
				
				if(count($NodesMenu)>0){
					$tree[]=Template::NodeReturn("Module_".$ModuleRecord->access_module_id,$ModuleRecord->module_name,$ModuleRecord->module_name,"","true",$NodesMenu);
				}else{
					$tree[]=Template::NodeReturn("Module_".$ModuleRecord->access_module_id,$ModuleRecord->module_name,$ModuleRecord->module_name,"","false",[]);
				}
				
			}
		}

		return $Note[]=Template::NodeReturn("Root_Menu","Menu de l'application","Menu par module","","true",$tree);
	}

	private function CreateTreeMenu(&$tree,$idmodule,$id=""){
		$MenuTable= new AccessMenuTable($this->adapter);
		$MenuRecord=NULL;
		if(empty($id)){
			$MenuRecord= $MenuTable->select("idaccessmodule=$idmodule AND  submenuid IS NULL");
		}else{
			$MenuRecord= $MenuTable->select("idaccessmodule=$idmodule AND submenuid=$id");
		}
	 
		if($MenuRecord){
			foreach($MenuRecord as $MenuElt){
				
				$children=[];
				$this->CreateTreeMenu($children,$idmodule,$MenuElt->access_menu_id);
				if(count($children)>0){
					$tree[]= Template::NodeReturn("Menu_".$MenuElt->access_menu_id."_".$idmodule,$MenuElt->menu_label,$MenuElt->menu_label,"","true",$children); 
				}else{
					$tree[]= Template::NodeReturn("Menu_".$MenuElt->access_menu_id."_".$idmodule,$MenuElt->menu_label,$MenuElt->menu_label,"","false",[]); 
				} 
			}
		}  
	}

	
	public function treeMenuAction(){
		
		$Nodes[]=$this->createTreeModuleMenu();
	  
		 $JsonModel =new JsonModel(array(
            "data"=>$Nodes,
        ));

		$JsonModel->setTerminal(true);
	 	return $JsonModel->setTemplate('communjson/json-view');

	}

	public function gestionMenuAction(){ 
 		$this->layout()->setTemplate('system/layout');
		return (new ViewModel([]))->setTemplate('menu/tree-menu-management');
	}
		
	
	public function menuGestionAction()
	{
		return (new ViewModel([]))->setTemplate('menu/menu-menu-management');
	}


	public function menuModuleAction()
	{
		$module_id=$this->params()->fromRoute('module',"");
		$view=new ViewModel(["module_id"=>$module_id]);
		$view->setTerminal(true);
		return $view->setTemplate('menu/menu-module');
	}


	public function menuMenuAction()
	{
		$module_id=$this->params()->fromRoute('module',"");
		$menu_id=$this->params()->fromRoute('id',"");
		$view=new ViewModel(["module_id"=>$module_id,"menu_id"=>$menu_id]);
		$view->setTerminal(true);
		return  $view->setTemplate('menu/menu-menu');
	}
	/**
	 * indexAction Mode d'accées consultation
	 * 
	 * @return void
	 */
	public function indexAction()
	{
        $MenuTable=new AccessMenuTable($this->adapter);
		$module_id=$this->params()->fromRoute('module',"");
		$submenu_id=$this->params()->fromRoute('idsubmenu',"");
		
		$ListeMenu=$MenuTable->getAllMenu($module_id,$submenu_id);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeMenu->setCurrentPageNumber($page);
		$ListeMenu->setItemCountPerPage(5);

		$view =  new ViewModel(['ListeMenu' => $ListeMenu,'module_id'=>$module_id,'submenu_id'=>$submenu_id]) ;
		$view->setTerminal(true);
		return $view->setTemplate('menu/menu-lister');
    }

    public function addMenuAction(){
        $MenuForm = new MenuForm($this->adapter);  
		$idParam=$this->params()->fromRoute("id","");
		$idsubmenu=$this->params()->fromRoute("idsubmenu","");
		$module_id=$this->params()->fromRoute("module","");
		if(!empty($idParam)){
			$MenuTable = new AccessMenuTable($this->adapter);
			$RecordMenu=$MenuTable->select("access_menu_id=$idParam");
			if($rec=$RecordMenu->current()){

				//Json contruct data from data base
				if($rec->templatemenuattribute){
					$templatemenuattribute=\Laminas\Json\Decoder::decode($rec->templatemenuattribute);
					foreach($templatemenuattribute as $key=> $json_elt){
						if(!isset($rec[$key])){
							$rec[$key]= $json_elt;
						} 
					}
				} 
				///////
				$MenuForm->populateValues($rec);
			} 
		}else{
			
			$MenuForm->populateValues(["idaccessmodule"=>$module_id,'submenuid'=>$idsubmenu]);
		}
		
		$view =  new ViewModel(['form' => $MenuForm,'menu_id'=>$idParam,'module_id'=>$module_id,'idsubmenu'=>$idsubmenu]);
        $view->setTerminal(true);	 
		return $view->setTemplate('menu/menu-add');
        
    }
	
	/**
	 * saveMenuAction
	 *	Enregistrer un nouveau Menu
	 * @return void
	 */
	public function saveMenuAction(){
		$request = $this->getRequest(); 
	    if($request->isPost()) { 
			$MenuForm = new MenuForm($this->adapter);  
			$MenuTable=new AccessMenuTable($this->adapter);
	    	$formData = $request->getPost()->toArray();
 	    	$MenuForm->setData($formData);

	    //	if($MenuForm->isValid()) {
	    		try {
					$data = $formData;//$MenuForm->getData();
					 //access_menu_id, , , , , , , , templatemenuattribute
					$dataInsert['idaccessmodule']=$data['idaccessmodule'];
					$dataInsert['menu_label']=$data['menu_label']; 
					$dataInsert['menuroute']=$data['menuroute'];  
					$dataInsert['menu_help']=$data['menu_help']; 
					$dataInsert['ordreaffichage']=$data['ordreaffichage']; 
					if(!empty($data['resource_id'])){
						$dataInsert['resource_id']=$data['resource_id'];  
					}
					if(!empty($data['submenuid'])){
						$dataInsert['submenuid']=$data['submenuid'];  
					}
					$JsonTemplate=[];
					if(isset($data['icone_class']) && !empty($data['icone_class']) ){
						$JsonTemplate['icone_class']=$data['icone_class'];  
					}
					if(isset($data['icone_class']) && !empty($data['icone_class']) ){
						$JsonTemplate['icone_class']=$data['icone_class'];  
					}
					$dataInsert['templatemenuattribute']=\Laminas\Json\Encoder::encode($JsonTemplate) ;  
					
					$menu_id=$this->params()->fromRoute("id",""); 
					if(!empty($menu_id)){
						$MenuTable->update($dataInsert,"access_menu_id=$menu_id"); 
					}else{
						$MenuTable->insert($dataInsert); 
					}
	    			
					$viewModel =new JsonModel( ['data' => ['status'=>'success','message'=>'Un nouveau Menu ajouter']]);

					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('communjson/json-view'); 
 
	    		} catch(RuntimeException $exception) {
					$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
			
					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('communjson/json-view'); 
	    		}
	    /*	}else{
				$message=$MenuForm->getMessages();
				foreach ($MenuForm->getMessages() as $messageId => $message) {
					$messages[]=("Validation failure ".$messageId .":". implode(";", $message) );
				}
				 
				$viewModel =new JsonModel( ['data' => ['status'=>'error','message'=>'Donnée non valide : '.implode(", ",$messages)]]);

				$viewModel->setTerminal(true);
				return $viewModel->setTemplate('communjson/json-view'); 
			}*/
	    }  
       
	}
	
	/**
	 * deleteRoleAction
	 *	Supprimer un role : la suppression engendre un ensemble de suppression en paralelle 
	 * @return void
	 */
	public function deleteMenuAction(){
		$request = $this->getRequest(); 
		$MenuTable=new AccessMenuTable($this->adapter);
		 

		try {
		 

			$menu_id=$this->params()->fromRoute("id");
			 
			$MenuTable->delete("access_menu_id=$menu_id");

			$viewModel =new JsonModel( ['data' => ['status'=>'success','message'=>'Suppression effectué']]);
			return $viewModel->setTemplate('communjson/json-view'); 
 		} catch(RuntimeException $exception) {
 			$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
	
			$viewModel->setTerminal(true);
			return $viewModel->setTemplate('communjson/json-view'); 
		}
	}



 
}