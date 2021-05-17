<?php

declare(strict_types=1);

namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Db\Adapter\Adapter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use RuntimeException;
use User\Form\Auth\CreateForm;
use User\Model\Table\UsersTable;

class AuthController extends AbstractActionController
{
	private $usersTable;
	private $adapter;    # database adapter

	public function __construct(Adapter $adapter,UsersTable $usersTable)
	{
		$this->adapter = $adapter;
		$this->usersTable = $usersTable;
	}

	public function createAction()
	{
		
		# make sure only visitors with no session access this page
		$auth = new AuthenticationService();
		if($auth->hasIdentity()) {
			# if user has session take them some else
			return $this->redirect()->toRoute('home');
		}

	    $createForm = new CreateForm($this->adapter);
	    $request = $this->getRequest();

	    if($request->isPost()) {
	    	$formData = $request->getPost()->toArray();
	    	$createForm->setInputFilter($this->usersTable->getCreateFormFilter());
	    	$createForm->setData($formData);

	    	if($createForm->isValid()) {
	    		try {
	    			$data = $createForm->getData();
	    			$this->usersTable->saveAccount($data); 

	    			$this->flashMessenger()->addSuccessMessage('Compte créé avec succès. Vous pouvez maintenant vous connecter');

	    			return $this->redirect()->toRoute('login');
	    		} catch(RuntimeException $exception) {
	    			$this->flashMessenger()->addErrorMessage($exception->getMessage());
	    			return $this->redirect()->refresh(); # refresh this page to view errors
	    		}
	    	}
	    }
		$this->layout()->setTemplate('login/index-layout');
		return (new ViewModel(['form' => $createForm]))->setTemplate('auth/create');
	}


    private function dossierupload($CIN){

		$reader = new \Laminas\Config\Reader\Ini(); 
		$config   = $reader->fromFile(DOOR.'/configs/uploadfile.ini');
    	 
    	$images=explode(",",$config->images);
    	$docs=explode(",",$config->docs);
    	
    	
    	$dir= $config->pathfiles."/".$CIN."/";
    	if(!(is_dir($dir)))
    	{
    		mkdir($dir, 0777, true);
    	}
    	$dir= $config->pathfiles."/".$CIN."/images/";
    	if(!(is_dir($dir)))
    	{
    		mkdir($dir, 0777, true);
    	}
    	
    	foreach ($images as $value){
    		$dir= $config->pathfiles."/".$CIN."/images/".$value."/";
    		if(!(is_dir($dir)))
    		{
    			mkdir($dir, 0777, true);
    		}
    	}
    	
    	
    	$dir= $config->pathfiles."/".$CIN."/docs/";
    	if(!(is_dir($dir)))
    	{
    		mkdir($dir, 0777, true);
    	}
    	foreach ($docs as $value){
    		$dir= $config->pathfiles."/".$CIN."/docs/".$value."/";
    		if(!(is_dir($dir)))
    		{
    			mkdir($dir, 0777, true);
    		}
    	}
    }



	
}
