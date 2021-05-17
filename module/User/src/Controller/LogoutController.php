<?php

declare(strict_types=1);

namespace User\Controller;

use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;

class LogoutController extends AbstractActionController
{
	public function indexAction()
	{
		$this->getEventManager()->trigger("isDeLoggedUser",null,["logout"=>"admin"]);

		$auth = new AuthenticationService();
		if($auth->hasIdentity()) {
			$auth->clearIdentity();
		}

		return $this->redirect()->toRoute('login');
	}
}
