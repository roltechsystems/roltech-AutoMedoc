<?php

declare(strict_types=1);

namespace User\Form\Auth;

use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\Captcha\Image;
use Laminas\Db\Adapter\Adapter; 

class CreateForm extends Form
{
	private $adapter;
	 
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('new_account');
		$this->setAttribute('method', 'post');
		$this->adapter=$adapter;
		# username input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'first_name',
			'options' => [
				'label' => 'Prénom'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 25,
				'pattern' => '^[a-zA-Z0-9]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Prénom must consist of alphanumeric characters only',
				'placeholder' => 'Tapez votre Prénom'
			]
		]);

		# username input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'last_name',
			'options' => [
				'label' => 'Nom'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 25,
				'pattern' => '^[a-zA-Z0-9]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'last_name must consist of alphanumeric characters only',
				'placeholder' => 'Tapez votre Nom'
			]
		]);

		# gender select field
		$this->add([
			'type' => Element\Select::class,
			'name' => 'gender',
			'options' => [
				'label' => 'Gender',
				'empty_option' => 'Votre sexe...',
				'value_options' => [
					'F' => 'Femme',
					'H' => 'Homme' 
				],
			],
			'attributes' => [
				'required' => true,
				'class' => 'form-control', # styling
			]
		]);

 



		# email address input field
		$this->add([
			'type' => Element\Email::class,
			'name' => 'email',
			'options' => [
				'label' => 'Address Email'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 128,
				'pattern' => '^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$',
				'autocomplete' => false,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',
				'title' => 'Fournissez une adresse e-mail valide et fonctionnelle',
				'placeholder' => 'Tapez votre Address Email.'
			]
		]);

		# confirm email address
		$this->add([
			'type' => Element\Email::class,
			'name' => 'confirm_email',
			'options' => [
				'label' => 'Verify Email Address'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 128,
				'pattern' => '^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$',
				'autocomplete' => false,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',
				'title' => "L'adresse e-mail doit correspondre à celle fournie ci-dessus",
				'placeholder' => 'Saisissez à nouveau votre adresse e-mail'
			]
		]);

		# birth day select field
		$this->add([
			'type' => Element\DateSelect::class,
			'name' => 'birthday',
			'options' => [
				'label' => 'Date de naissance',
				'create_empty_option' => true,
				'max_year' => date('Y') - 18, # here we want users over the age of 13 only
				'render_delimiters' => false,
				'year_attributes' => [
					'class' => 'custom-select w-30'
				],
				'month_attributes' => [
					'class' => 'custom-select w-30'
				],
				'day_attributes' => [
					'class' => 'custom-select w-30',
					'id' => 'day'
				],
			],
			'attributes' => [
				'required' => true
			]
		]);

		

		# password input field
		$this->add([
			'type' => Element\Password::class,
			'name' => 'password',
			'options' => [
				'label' => 'Password'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 25,
				'autocomplete' => false,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling
				'title' => 'Le mot de passe doit comporter entre 8 et 25 caractères',
				'placeholder' => 'Tapez votre mot de passe'
			]
		]);

		# confirm password input field
		$this->add([
			'type' => Element\Password::class,
			'name' => 'confirm_password',
			'options' => [
				'label' => 'Verify Password'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 25,
				'autocomplete' => false,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling
				'title' => 'Le mot de passe doit correspondre à celui fourni ci-dessus',
				'placeholder' => 'Entrez à nouveau votre mot de passe'
			]
		]);

		# cross-site-request forgery (csrf) field
		$this->add([
			'type' => Element\Csrf::class,
			'name' => 'csrf',
			'options' => [
				'csrf_options' => [
					'timeout' => 600,  # 5 minutes
				]
			]
		]);
  
		# captcha field
		$this->add([
			'type' => Element\Captcha::class,
			'name' => 'turing',
			'options' => [
				'label' => 'Vérifiez que vous êtes humain?',
				'captcha' => new Image([
					'font' => DOOR . DS . 'public/fonts/ubi.ttf',
					'fsize' => 55,
					'wordLen' => 6,
					'imgAlt' => 'image captcha',
					'height' => 100,
					'width' => 300,
					'dotNoiseLevel' => 220,
					'lineNoiseLevel' => 18,
				]),
			],
			'attributes' => [
				'size' => 40,
				'required' => true,
				'maxlength' => 6,
				'pattern' => '^[a-zA-Z0-9]+$',
				'class' => 'custom-control',
				'data-toggle' => 'tooltip',
				'title' => 'Fournir le texte affiché ',
				'placeholder' => 'Tapez les caractères affichés',
				'captcha' => (new Element\Captcha())->getInputSpecification(), # validation
			],
		]);
		# submit button
		$this->add([
			'type' => Element\Submit::class,
			'name' => 'create_account',
			'attributes' => [
				'value' => 'Créer votre compte',
				'class' => 'btn btn-warning text-white'
			]
		]);
	}
}

