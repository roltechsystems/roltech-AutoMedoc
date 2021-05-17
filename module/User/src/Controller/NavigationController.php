<?php

declare(strict_types=1);

namespace User\Controller;

use Laminas\View\Model\ViewModel;
use Laminas\Authentication\AuthenticationService;
use Laminas\Db\Adapter\Adapter;
use Laminas\Mvc\Controller\AbstractActionController;
use User\Model\Entity\ModulesEntity;
use User\Model\Table\RolesTable;

class NavigationController extends AbstractActionController
{
    private $Roleuser;
    private $adapter;    # database adapter 

	public function __construct(Adapter $adapter )
	{
		$this->adapter = $adapter;
        $auth = new AuthenticationService();
	    $this->Roleuser=(string) $auth->getIdentity()->role_id;
		 
	}
 

    public function navigationAdminAction(){
        $this->layout()->setTemplate('Navigation/Navigation-layout');

        $Roletable=new RolesTable($this->adapter);
        $AllRoleUser=$Roletable->getAllResourceByRole($this->Roleuser);
        $ListeModules=[];
        foreach($AllRoleUser as   $RessourceForMe){
            $ListeModules[$RessourceForMe->getModulename()]["afficher"]=$RessourceForMe->getModuleafficher();
            $ListeModules[$RessourceForMe->getModulename()]["description"]=$RessourceForMe->getModuledescrept();
            $ListeModules[$RessourceForMe->getModulename()]["modes"][]=$RessourceForMe->getLabelaccessmode();
            
        }
        
		return (new ViewModel(['ListeModules' => $ListeModules]))->setTemplate('Navigation/admin');
    }
}
