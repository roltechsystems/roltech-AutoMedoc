<?php

declare(strict_types=1);

namespace System\Form\Privilege;

use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\Captcha\Image;
use Laminas\Db\Adapter\Adapter;
use System\Model\Table\AccessModeTable;
use System\Model\Table\AccessModulesTable;
use System\Model\Table\AccessResourcesTable;
use System\Model\Table\AccessRolesTable;

class PrivilegeForm extends Form
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
		parent::__construct('new_previlege');
		$this->setAttribute('method', 'post');
		$this->adapter=$adapter;  
		 
  		$AccessModules=$this->AccessModules();
	 	$AccessMode=$this->AccessMode();
		 
		 


		foreach($AccessModules as $key => $Module)
		{
			#idaccessmodules		
			$this->add([
				'type' => Element\Checkbox::class,
				'name' => 'idaccessmodules_'.$key,
				'options' => [
					'label' => $Module,
					'use_hidden_element' => true,
					'checked_value' => $key,
					'unchecked_value' => 0,
				],
				'attributes' => [ 
					'class' => 'form-control', # styling
				]
			]);
		 
			#idaccessmode	
			$this->add([
				'type' => Element\MultiCheckbox::class,
				'name' => 'idaccessmode_'.$key,
				'options' => [
					'label' => 'Mode de gestion',  
					'value_options' => $AccessMode,
				],
				'attributes' => [ 
					'class' => 'form-control', # styling
					"style"=>" display: inline-block;width:100%;"
				]
			]);	 

		} 
	  

        # add the user_id hidden field
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'role_id'
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
			'name' => 'create_Privilege',
			'attributes' => [
				'value' => 'Enregistrer',
				'class' => 'btn btn-success'
			]
		]);
	}
}

