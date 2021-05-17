<?php

declare(strict_types=1);

namespace System\Form\Modules;

use Laminas\Form\Form;
use Laminas\Form\Element;
 

 //access_module_id, moduleroute, module_name, module_descrept, module_afficher, templateattruibute
class ModulesForm extends Form
{
 
	 
	public function __construct($name = null)
	{
		parent::__construct('new_Modules');
		$this->setAttribute('method', 'post'); 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'module_name',
			'options' => [
				'label' => 'Nom de module'
			],
			'attributes' => [
				'required' => true,
				'size' => 55,
				'maxlength' => 55,
				'pattern' => '^[a-zA-Z0-9.-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Nom de modules',
				'placeholder' => 'Tapez le nom de module'
			]
		]);
		# action input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'moduleroute',
			'options' => [
				'label' => 'Module URL'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 25,
				'pattern' => '^[a-zA-Z0-9.-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Module Route editer par un super-administrateur',
				'placeholder' => 'Tapez la route du module'
			]
		]);
		  


		$this->add([
			'type' => Element\Checkbox::class,
			'name' => 'module_afficher',
			'options' => [
				'label' => 'Afficher le module',
				'label_attributes' => [
					'class' => 'custom-control-label'
				],
				'use_hidden_element' => true,
				'checked_value' => 1, 
				'unchecked_value' => 0,
			],
			'attributes' => [
				'value' => 0,
				'id' => 'module_afficher', 
				'class' => 'custom-control-input'
			]
		]);

		# add the descreption textarea field
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'module_descrept',
            'options' => [
                'label' => 'Description'
            ],
            'attributes' => [
                'required' => true,
                'row' => 3,
                'maxlength' => 500,
                'title' => 'Description de module ',
                'class' => 'form-control',
                'placeholder' => 'Description...'
            ]
        ]);

        # add the access_module_id hidden field
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'access_module_id'
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

