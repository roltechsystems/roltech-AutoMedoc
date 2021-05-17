<?php

declare(strict_types=1);

namespace System\Form\Ressources;

use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\Captcha\Image;
use Laminas\Db\Adapter\Adapter;
use System\Model\Table\AccessModeTable;
use System\Model\Table\AccessModulesTable;
class RessourcesForm extends Form
{
	private $adapter;
	private function AccessMode(): array
	{
		$AccessMode=new AccessModeTable($this->adapter);
		$AccessModeRecord=$AccessMode->select();
		$ListeMode=[];
		foreach($AccessModeRecord as $p){
			$ListeMode[$p->idaccessmode]=$p->labelaccessmode;
		}
		return $ListeMode;
	}

	private function AccessModules(): array
	{
		$AccessModules=new AccessModulesTable($this->adapter);
		$AccessModulesRecord=$AccessModules->select();
		$ListeModules=[];
		foreach($AccessModulesRecord as $p){
			$ListeModules[$p->access_module_id]=$p->module_name;
		}
		return $ListeModules;
	}
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('new_ressource');
		$this->setAttribute('method', 'post');
		$this->adapter=$adapter; 

		# module input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'module',
			'options' => [
				'label' => 'Module'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 200,
				'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Module must consist of alphanumeric characters only',
				'placeholder' => 'Tapez votre module'
			]
		]);

		# controller input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'controller',
			'options' => [
				'label' => 'Controlleur'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 200,
				'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'controlleur must consist of alphanumeric characters only',
				'placeholder' => 'Tapez votre controlleur'
			]
		]);

		# action input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'action',
			'options' => [
				'label' => 'Action'
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 200,
				'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'action must consist of alphanumeric characters only',
				'placeholder' => 'Tapez votre action'
			]
		]);
		 
		#idaccessmodules		
		$this->add([
			'type' => Element\Select::class,
			'name' => 'idaccessmodules',
			'options' => [
				'label' => 'Modules/Service',
				'empty_option' => 'Modules/Service...',
				'value_options' =>$this->AccessModules() ,
			],
			'attributes' => [
				'required' => true,
				'class' => 'form-control', # styling
			]
		]);		

		#idaccessmode		
		$this->add([
			'type' => Element\Select::class,
			'name' => 'idaccessmode',
			'options' => [
				'label' => 'Mode de gestion',
				'empty_option' => 'Mode de gestion...',
				'value_options' =>$this->AccessMode() ,
			],
			'attributes' => [
				'required' => true,
				'class' => 'form-control', # styling
			]
		]);		

	 

		# add the comment textarea field
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'resources_descrept',
            'options' => [
                'label' => 'description'
            ],
            'attributes' => [
                'required' => true,
                'row' => 3,
                'maxlength' => 500,
                'title' => 'Description de ressource ',
                'class' => 'form-control',
                'placeholder' => 'description...'
            ]
        ]);

        # add the user_id hidden field
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'resource_id'
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
			'name' => 'create_ressources',
			'attributes' => [
				'value' => 'Enregistrer',
				'class' => 'btn btn-success'
			]
		]);
	}
}

