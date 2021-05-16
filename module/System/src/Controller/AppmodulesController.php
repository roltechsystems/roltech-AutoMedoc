<?php 

declare(strict_types=1);

namespace System\Controller;

use Laminas\Db\Adapter\Adapter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Filter\File\Rename;
use System\Form\Modules\ModulesForm;
use System\Model\Table\AccessModulesTable;

class AppmodulesController extends AbstractActionController
{

    private $adapter;    # database adapter

	public function __construct(Adapter $adapter)
	{ 
	    $this->adapter=$adapter;
	}

    public function indexAction(){
        $moduleTable=new AccessModulesTable($this->adapter);

	 
		$ListeModule=$moduleTable->getAllModules(true);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeModule->setCurrentPageNumber($page);
		$ListeModule->setItemCountPerPage(5);
		$view =    new   ViewModel(['ListeModules' => $ListeModule]);
        $view->setTerminal(true);
		return  $view->setTemplate('system/lister-module');
    }
    public function editAction(){
        $ModuleForm = new ModulesForm(); 

		
		$view =  new ViewModel(['form' => $ModuleForm]);
        $view->setTerminal(true);	 
		return $view->setTemplate('system/add-modules');
        
    }

}