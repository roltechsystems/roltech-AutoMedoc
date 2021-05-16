<?php 

declare(strict_types=1);

namespace System\Controller;


use Laminas\View\Model\JsonModel;
 
use Laminas\Db\Adapter\Adapter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Filter\File\Rename;
use Limostr\Tools\Template;
use System\Form\Ressources\RessourcesForm;
use System\Model\Table\AccessResourcesTable;
use RuntimeException;
use System\Model\Table\AccessModeTable;
use System\Model\Table\AccessModulesTable;

class RessourcesController extends AbstractActionController
{

 
	private $adapter;    # database adapter

	public function __construct(Adapter $adapter)
	{ 
	 $this->adapter=$adapter;
	}

	public function treeRessourcesAction(){
		
		$ModeTable = new AccessModeTable($this->adapter);
    	$ModuleTable= new AccessModulesTable($this->adapter);
		$RessourceTable=new AccessResourcesTable($this->adapter);
    	 
    	$listeMode=$ModeTable->Select();
		$ListeModule=$ModuleTable->select();
    	$RessourcesTree=[];
		$NodeMode=[];
		 
		foreach($listeMode as $mode){
			$NodeMode[]= Template::NodeReturn("Mode_".$mode->idaccessmode,$mode->labelaccessmode,$mode->labelaccessmode,"","false",[]); 
		}
    	foreach ($ListeModule as  $Module){ 
			$NodeModeTmp=$NodeMode;
			foreach($NodeModeTmp as $key => $mode){
				$mode_id=explode('_',$NodeModeTmp[$key]['key']);
				$RessourcesListe=$RessourceTable->select(['idaccessmodules'=>$Module->access_module_id,'idaccessmode'=>$mode_id[1]]);
				foreach($RessourcesListe as $ress){ 
					$NodeModeTmp[$key]['children'][]=Template::NodeReturn("Ressources_".$ress->resource_id,$ress->module."/".$ress->controller."/".$ress->action,$ress->module."/".$ress->controller."/".$ress->action,"","false",[]);
				} 
				$NodeModeTmp[$key]['key']=$NodeModeTmp[$key]['key']."_Module_".$Module->access_module_id; 
			}
       		$NodeRole= Template::NodeReturn("Module_".$Module->access_module_id,$Module->module_name,$Module->module_name,"","true",$NodeModeTmp); 
			$RessourcesTree[]=$NodeRole; 
    	}
		 
		$Note[]=Template::NodeReturn("Ressources_Root","Liste des Ressources","Liste des ressources gérer dans SmartUniversity","","true",$RessourcesTree);
	  
		 $JsonModel =new JsonModel(array(
            "data"=>$Note,
        ));

		$JsonModel->setTerminal(true);
	 	return $JsonModel;

	}

	public function gestionRessourcesAction(){ 
		$this->layout()->setTemplate('system/layout');
	   return (new ViewModel([]))->setTemplate('system/tree-ressources-management');
   }
   public function getoptionRessourceAction(){
	   
		$ressourceTable=new AccessResourcesTable($this->adapter);
		$module_id=$this->params()->fromRoute("module","");
		$ressourcesRec=$ressourceTable->select("idaccessmodules=$module_id");
		$option[""]="Ressources";
		foreach($ressourcesRec as $r){
			$option[$r->resource_id]=$r->module."/".$r->controller."/".$r->action;
		}

		$viewModel =new JsonModel( ['data'=> $option]  ); 
		$viewModel->setTerminal(true);
		return $viewModel->setTemplate('communjson/json-view');  
   }
	public function indexAction()
	{

		$ressourceTable=new AccessResourcesTable($this->adapter);

	 
		$ListeRessources=$ressourceTable->fetchAllReressource(true);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeRessources->setCurrentPageNumber($page);
		$ListeRessources->setItemCountPerPage(5);
		$view =    new   ViewModel(['ListeRessources' => $ListeRessources]);
        $view->setTerminal(true);
		return  $view->setTemplate('system/lister-ressources');
	}

	public function filterModuleAction()
	{

		$ressourceTable=new AccessResourcesTable($this->adapter);

		$moduleParam=$this->params()->fromRoute("module");
		$modeParam=$this->params()->fromRoute("mode");
		
		$ListeRessources=$ressourceTable->fetchAllReressource(true,$moduleParam,$modeParam);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeRessources->setCurrentPageNumber($page);
		$ListeRessources->setItemCountPerPage(5);
		$view =    new   ViewModel(['ListeRessources' => $ListeRessources,'mode'=>$modeParam,'module'=>$moduleParam]);
        $view->setTerminal(true);
		return  $view->setTemplate('system/lister-ressources');
	}

	public function editAction(){  
	    $RessourcesForm = new RessourcesForm($this->adapter);
		$idParam=$this->params()->fromRoute("id","");
	 
		if(!empty($idParam)){
			$RessourceRable = new AccessResourcesTable($this->adapter);
			$RecordRessource=$RessourceRable->select("resource_id=$idParam");
			if($rec=$RecordRessource->current()){
				$RessourcesForm->populateValues($rec);
			} 
		} 
		$view = new ViewModel(['form' => $RessourcesForm,"id"=>$idParam]);


		$view->setTerminal(true); 
		return $view->setTemplate('system/add-ressources');
		 
	} 

	public function saveRessourcesAction(){
		$RessourcesForm = new RessourcesForm($this->adapter);
		$request = $this->getRequest();
	
	    if($request->isPost()) { 

			$ressourceTable=new AccessResourcesTable($this->adapter);
	    	$formData = $request->getPost()->toArray();
	    	//$RessourcesForm->setInputFilter($ressourceTable->getRessourcesFormFilter());
	    	$RessourcesForm->setData($formData);

	    	if($RessourcesForm->isValid()) {
	    		try {
					$data = $RessourcesForm->getData();
					//$dataInsert['resource_id']=$data;
					$dataInsert['module']=$data['module'];
					$dataInsert['controller']=$data['controller'];
					$dataInsert['action']=$data['action'];
					$dataInsert['idaccessmodules']=$data['idaccessmodules']; 
					$dataInsert['resources_descrept']=$data['resources_descrept'];
					$dataInsert['idaccessmode']	=$data['idaccessmode']; 
					if(isset($data['resource_id']) && !empty($data['resource_id'])){
						$ressourceTable->update($dataInsert,['resource_id'=>$data['resource_id']]); 
					}else{
						$ressourceTable->insert($dataInsert); 
					}
					
	    			


					$viewModel =new JsonModel( ['data' => ['status'=>'success','message'=>'Un nouveau ressource ajouter']]);

					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('communjson/json-view'); 
	    		 
	    		} catch(RuntimeException $exception) {
					$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
			
					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('communjson/json-view'); 
	    		}
	    	}
	    }

	}

	public function deleteRessourceAction(){

	}
}