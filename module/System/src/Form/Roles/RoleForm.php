<?php

declare(strict_types=1);

namespace System\Form\Roles;

use Laminas\Form\Form;
use Laminas\Form\Element;
 

 
class RoleForm extends Form
{
 
	 
	public function __construct($name = null)
	{
		parent::__construct('new_Role');
		$this->setAttribute('method', 'post'); 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'role_id',
			'options' => [
				'label' => 'Identifiant de Role'
			],
			'attributes' => [
				'required' => true,
				'size' => 55,
				'maxlength' => 55,
				'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Identifiant doit etre un alphanumérique ',
				'placeholder' => 'Tapez le identifiant de role'
			]
		]);
		# action input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'role_name',
			'options' => [
				'label' => 'Role'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 25,
				'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Identifiant doit etre un alphanumérique',
				'placeholder' => 'Tapez le nouveau role'
			]
		]);
		  

		# add the descreption textarea field
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'role_descrept',
            'options' => [
                'label' => 'Description'
            ],
            'attributes' => [
                'required' => true,
                'row' => 3,
                'maxlength' => 500,
                'title' => 'Description de Role ',
                'class' => 'form-control',
                'placeholder' => 'Description...'
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
  
		 
		# submit button
		$this->add([
			'type' => Element\Submit::class,
			'name' => 'create',
			'attributes' => [
				'value' => 'Enregistrer',
				'class' => 'btn btn-success'
			]
		]);
	}
}

