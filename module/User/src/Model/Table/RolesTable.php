<?php

declare(strict_types=1);

namespace User\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
use User\Model\Entity\ModulesEntity;
use User\Model\Entity\RoleEntity; # add this
 



class RolesTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'access_roles';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function fetchRoleById(string $roleId)
	{
		$sqlQuery = $this->sql->select()->where(['role_id' => $roleId]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler  = $sqlStmt->execute()->current();
	 
		if(!$handler) {
			return null;
		}
	//	echo"<pre>";print_r($handler);echo"</pre>";
		$hydrator = new ClassMethodsHydrator();
		$entity   = new RoleEntity(); 
		$hydrator->hydrate($handler, $entity);
	//	print_r( $entity);
		return $entity;
	}

	public function fetchRole(string $role)
	{
		 
		$sqlQuery = $this->sql->select()->where(['role_name' => $role]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler  = $sqlStmt->execute()->current();
		 
		if(!$handler) {
			return null;
		}
		
		$hydrator = new ClassMethodsHydrator();
		$entity   = new RoleEntity();
		$hydrator->hydrate($handler, $entity);

		return $entity;
	}

	public function getAllResourceByRole(string $role)
	{

		$sqlQuery = $this->sql->select()
		->join('access_privileges', 'access_privileges.role_id='.$this->table.'.role_id', ['role_id'],Select::JOIN_LEFT)
		->join('access_resources', 'access_resources.resource_id=access_privileges.resource_id',['module', 'controller', 'action','idaccessmodules','idaccessmode'],Select::JOIN_LEFT)
		->join('access_mode', 'access_resources.idaccessmode=access_mode.idaccessmode',['labelaccessmode', 'descaccessmode'],Select::JOIN_LEFT)
		->join('access_modules', 'access_modules.access_module_id=access_resources.idaccessmodules',['module_name', 'module_descrept','module_afficher'],Select::JOIN_LEFT)
		;
	
		$sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler = $sqlStmt->execute();

		$hydrator = new ClassMethodsHydrator();
		$entity = new ModulesEntity();
	 	$resultSet = new HydratingResultSet($hydrator, $entity);
		$resultSet->initialize($handler);

		return $resultSet;
	}
}