<?php

declare(strict_types=1);

namespace User\Form\Auth;

use Laminas\Db\Adapter\Adapter;
use Laminas\Form\Element;
use Laminas\Form\Form;
 

class LoginAdminForm extends Form
{
	private $adapter;
	 
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('new_account');
		$this->setAttribute('method', 'post');
		$this->adapter=$adapter;
		parent::__construct('sign_in');
		$this->setAttribute('method', 'post');

		# email address input field
		$this->add([
			'type' => Element\Email::class,
			'name' => 'email',
			'options' => [
				'label' => 'Email',
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 128,
				'pattern' => '^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$',
				'autocomplete' => false,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',
				'title' => 'Tapez votre adresse email',
				'placeholder' => 'Tapez votre adresse email',
			],
		]);

		# password input field
		$this->add([
			'type' => Element\Password::class,
			'name' => 'password',
			'options' => [
				'label' => 'Mot de passe'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 25,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',
				'title' => 'Tapez votre mot de passe',
				'placeholder' => 'Tapez votre mot de passe',
			]
		]);

		 	


		# remember me checkbox
		$this->add([
			'type' => Element\Checkbox::class,
			'name' => 'recall',
			'options' => [
				'label' => 'Rester connecté ?',
				'label_attributes' => [
					'class' => 'custom-control-label'
				],
				'use_hidden_element' => true,
				'checked_value' => 1, 
				'unchecked_value' => 0,
			],
			'attributes' => [
				'value' => 0,
				'id' => 'recall', 
				'class' => 'custom-control-input'
			]
		]);

		$this->add([
			'type' => Element\Hidden::class,
			'name' => 'returnUrl'
		]);

		# csrf hidden field
		$this->add([
			'type' => Element\Csrf::class,
			'name' => 'csrf',
			'options' => [
				'csrf_options' => [
					'timeout' => 600,   # 10 minutes
				]
			],
		]);

		# submit button
		$this->add([
			'type' => Element\Submit::class,
			'name' => 'account_login',
			'attributes' => [
				'value' => 'Connectez-vous',
				'class' => 'btn btn-primary'
			]
		]);
	}
}
