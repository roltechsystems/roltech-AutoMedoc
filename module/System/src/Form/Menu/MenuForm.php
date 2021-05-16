<?php

declare(strict_types=1);

namespace System\Form\Menu;

use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\Db\Adapter\Adapter;
use System\Model\Table\AccessMenuTable;
use System\Model\Table\AccessModulesTable;
use System\Model\Table\AccessResourcesTable;

 class MenuForm extends Form
{
	protected $adapter;
	private function getMenu(){
		$AccessMenu=new AccessMenuTable($this->adapter);
		$AccessMenuRecord=$AccessMenu->select();
		$ListeMenu[""]="";
		foreach($AccessMenuRecord as $p){
			$ListeMenu[$p->access_menu_id]=$p->menu_label."(".$p->menuroute.")";
		}
		return $ListeMenu;
	}
	 
	private function AccessModules(): array
	{
		$AccessModules=new AccessModulesTable($this->adapter);
		$AccessModulesRecord=$AccessModules->select();
		$ListeModules[""]="";
		foreach($AccessModulesRecord as $p){
			$ListeModules[$p->access_module_id]=$p->module_name;
		}
		return $ListeModules;
	}

	private function getRessources(){
		$AccessRessources=new AccessResourcesTable($this->adapter);
		$AccessRessourcesRecord=$AccessRessources->select();
		$ListeRessources[""]="";
		foreach($AccessRessourcesRecord as $p){
			$ListeRessources[$p->resource_id]=$p->module."/".$p->controller."/".$p->action;
		}
		return $ListeRessources;
	}
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('new_Menu');

		$this->adapter=$adapter;
		$this->setAttribute('method', 'post'); 
		$this->add([
			'type' => Element\Select::class,
			'name' => 'idaccessmodule',
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
		$this->add([
			'type' => Element\Select::class,
			'name' => 'submenuid', 
			'options' => [
				'label' => 'Sous menu', 
				'empty_option' => 'Sous menu...',
				'value_options' =>$this->getMenu() , 
			],
			'attributes' => [   
				'class' => 'form-control', # styling
			]
		]);	
		
		$this->add([
			'type' => Element\Select::class,
			'name' => 'resource_id',
			'required' => false,
			'options' => [
				'label' => 'Ressource',
				'empty_option' => 'Ressource...',
				'value_options' =>$this->getRessources(),
				'disable_inarray_validator' => true,
			],
			'attributes' => [   
				'class' => 'form-control', # styling
			]
		]);	

		$this->add([
			'type' => Element\Text::class,
			'name' => 'menu_label',
			'options' => [
				'label' => 'Titre de menu'
			],
			'attributes' => [
				'required' => true, 
				'maxlength' => 512, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Titre de menu ',
				'placeholder' => 'Tapez le Titre de menu'
			]
		]);
		# action input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'menuroute',
			'options' => [
				'label' => 'Lien'
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => "Lien d'accés au service" ,
				'placeholder' => 'Tapez la route de lien'
			]
		]);
		$this->add([
			'type' => Element\Text::class,
			'name' => 'icone_class',
			'options' => [
				'label' => 'Icone'
			],
			'attributes' => [ 
				'class' => 'form-control',   # styling the text field
				'title' => 'Icone Classe ',
				'placeholder' => "Tapez le la classe de l'Icone utilisé"
			]
		]);
		  
		$this->add([
			'type' => Element\Number::class,
			'name' => 'ordreaffichage',
			'options' => [
				'label' => "Ordre d'affichage"
			],
			'attributes' => [
				'required' => true,   
				'class' => 'form-control',   # styling the text field
				'title' => "Ordre d'affichage" ,
				'placeholder' => "Tapez l'Ordre d'affichage"
			]
		]);
		  
		# add the descreption textarea field
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'menu_help',
            'options' => [
                'label' => 'Aide'
            ],
            'attributes' => [
                'required' => true,
                'row' => 3,
                'maxlength' => 500,
                'title' => 'Aide de menu ',
                'class' => 'form-control',
                'placeholder' => 'Aide...'
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

