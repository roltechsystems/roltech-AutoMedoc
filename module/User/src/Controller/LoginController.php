<?php

declare(strict_types=1);

namespace User\Controller;

use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Result;
use Laminas\Crypt\Password\Bcrypt;
use Laminas\Db\Adapter\Adapter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\SessionManager;
use Laminas\View\Model\ViewModel;
use User\Form\Auth\LoginAdminForm;
use User\Form\Auth\LoginForm;
use User\Model\Table\UsersTable;
use User\Model\UrlModel;

class LoginController extends AbstractActionController
{
	private $adapter;    # database adapter
	private $usersTable; # table we store data in

	public function __construct(Adapter $adapter, UsersTable $usersTable)
	{
		$this->adapter = $adapter;
		$this->usersTable = $usersTable;
	}

	public function indexAction()
	{
		
		$auth = new AuthenticationService();
		if($auth->hasIdentity()) {
			return $this->redirect()->toRoute('tableau-de-bord');
		}

		$loginForm = new LoginForm();
		$loginForm->get('returnUrl')->setValue(
			$this->getEvent()->getRouteMatch()->getParam('returnUrl')
		);

		$request = $this->getRequest();

		if($request->isPost()) {
			$formData = $request->getPost()->toArray();
			$loginForm->setInputFilter($this->usersTable->getLoginFormFilter());
			$loginForm->setData($formData);

			if($loginForm->isValid()) {
				$authAdapter = new CredentialTreatmentAdapter($this->adapter);
				$authAdapter->setTableName($this->usersTable->getTable())
				            ->setIdentityColumn('email')
				            ->setCredentialColumn('password')
				            ->getDbSelect()->where(['active' => 1]);

				# data from loginForm
				$data = $loginForm->getData();
				$returnUrl = $this->params()->fromPost('returnUrl');
				$authAdapter->setIdentity($data['email']);


				# password hashing class
				$hash = new Bcrypt();

				# well let us use the email address from the form to retrieve data for this user
				$info = $this->usersTable->fetchAccountByEmail($data['email']);

				# now compare password from form input with that already in the table
				if($hash->verify($data['password'], $info->getPassword())) {
					$authAdapter->setCredential($info->getPassword());
				} else {
					$authAdapter->setCredential(''); # why? to gracefully handle errors
				}

				$authResult = $auth->authenticate($authAdapter);

				switch ($authResult->getCode()) {
					case Result::FAILURE_IDENTITY_NOT_FOUND:
						$this->flashMessenger()->addErrorMessage('Adresse e-mail inconnue!');
						return $this->preserveUrl($returnUrl);
						//return $this->redirect()->refresh(); # refresh the page to show error
						break;

					case Result::FAILURE_CREDENTIAL_INVALID:
						$this->flashMessenger()->addErrorMessage('Mot de passe incorrect!');
						return $this->redirect()->refresh(); # refresh the page to show error
						break;
						
					case Result::SUCCESS:
						if($data['recall'] == 1) {
							$ssm = new SessionManager();
							$ttl = 1814400; # time for session to live
							$ssm->rememberMe($ttl);
						}

						$storage = $auth->getStorage();
						$storage->write($authAdapter->getResultRowObject(null, ['created', 'modified']));
						//print_r($authAdapter->getResultRowObject() );die();
						if (!empty($returnUrl)) {
							# will come back to later... if script does not work.
							return $this->preserveUrl($returnUrl);
						}

						# let us now create the profile route and we will be done
						return $this->redirect()->toRoute(
							'dashboard', 
							[
								'id' => $info->getEmail(),
								'username' => mb_strtolower($info->getEmail())
							]
						);

						break;		
					
					default:
						$this->flashMessenger()->addErrorMessage('Authentification échouée. Réessayer');
						return $this->preserveUrl($returnUrl);
						//return $this->redirect()->refresh(); # refresh the page to show error
						break;
				}
			}
		}
		$this->layout()->setTemplate('login/index-layout');
		return (new ViewModel(['form' => $loginForm]))->setTemplate('login/index');
	}

	private function preserveUrl(string $returnUrl = null)
	{
		if (empty($returnUrl)) {
			return $this->redirect()->refresh();
		}

		# we have not yet created the UrlModel class. Let us do so now..
		return $this->redirect()->toUrl(UrlModel::decode($returnUrl));
	}

	public function loginAdminAction(){
		
		$auth = new AuthenticationService();
		if($auth->hasIdentity()) {
			$this->getEventManager()->trigger("isLoggedUser",null,["logged"=>"admin"]);
			return $this->redirect()->toRoute('navigation');
		}

		$loginForm = new LoginAdminForm($this->adapter);
		$loginForm->get('returnUrl')->setValue(
			$this->getEvent()->getRouteMatch()->getParam('returnUrl')
		);
		
		
		$request = $this->getRequest();

		if($request->isPost()) {
			$formData = $request->getPost()->toArray();
			$loginForm->setInputFilter($this->usersTable->getLoginFormFilter());
			$loginForm->setData($formData);

			if($loginForm->isValid()) {
				$authAdapter = new CredentialTreatmentAdapter($this->adapter);
				$authAdapter->setTableName($this->usersTable->getTable())
				            ->setIdentityColumn('email')
				            ->setCredentialColumn('password')
				            ->getDbSelect()->where(['active' => 1]);
						 
			 
				# data from loginForm
				$data = $loginForm->getData();
				$returnUrl = $this->params()->fromPost('returnUrl');
				$authAdapter->setIdentity($data['email']);


				# password hashing class
				$hash = new Bcrypt();

				# well let us use the email address from the form to retrieve data for this user
				$info = $this->usersTable->fetchAccountByEmail($data['email']);

				# now compare password from form input with that already in the table
				if($hash->verify($data['password'], $info->getPassword())) {
					$authAdapter->setCredential($info->getPassword());
				} else {
					$authAdapter->setCredential(''); # why? to gracefully handle errors
				}

				$authResult = $auth->authenticate($authAdapter);

				switch ($authResult->getCode()) {
					case Result::FAILURE_IDENTITY_NOT_FOUND:
						$this->flashMessenger()->addErrorMessage('Adresse e-mail inconnue!');
						return $this->preserveUrl($returnUrl);
						//return $this->redirect()->refresh(); # refresh the page to show error
						break;

					case Result::FAILURE_CREDENTIAL_INVALID:
						$this->flashMessenger()->addErrorMessage('Mot de passe incorrect!');
						return $this->redirect()->refresh(); # refresh the page to show error
						break;
						
					case Result::SUCCESS:
						if($data['recall'] == 1) {
							$ssm = new SessionManager();
							$ttl = 1814400; # time for session to live
							$ssm->rememberMe($ttl);
						}

						$storage = $auth->getStorage();
						$storage->write($authAdapter->getResultRowObject(null, ['created', 'modified','changermotdepasse','password']));

						if (!empty($returnUrl)) {
							# will come back to later... if script does not work.
							return $this->preserveUrl($returnUrl);
						}
						$this->getEventManager()->trigger("isLoggedUser",null,["logged"=>"admin"]);
						# let us now create the profile route and we will be done
						return $this->redirect()->toRoute('navigation');

						break;		
					
					default:
						$this->flashMessenger()->addErrorMessage('Authentification échouée. Réessayer');
						return $this->preserveUrl($returnUrl);
						//return $this->redirect()->refresh(); # refresh the page to show error
						break;
				}
			}
		}
		
		$this->layout()->setTemplate('login/login-admin-layout');
		return (new ViewModel(['form' => $loginForm]))->setTemplate('login/login-admin');
	}
}
