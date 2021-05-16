<?php

declare(strict_types=1);

namespace System\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
use System\Model\Entity\AccessResourcesEntity; # add this
use Laminas\Paginator\Adapter\DbSelect; 
use Laminas\Paginator\Paginator;
use System\Model\Entity\PrevilegeResourcesEntity;
use System\Model\Entity\RoleEntity;

class AccessRolesTable  extends AbstractTableGateway
{
    protected $adapter;
	protected $table = 'access_roles';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function getAllRoles(){
		$sqlQuery = $this->sql->select()->order('role_id ASC');

	 
		$classMethod = new ClassMethodsHydrator();
		$entity      = new RoleEntity();
		$resultSet   = new HydratingResultSet($classMethod, $entity);

		$paginatorAdapter = new DbSelect(
			$sqlQuery,
			$this->adapter,
			$resultSet
		);

		$paginator = new Paginator($paginatorAdapter); 
		return $paginator;
		 
	}

    public function getAllPrivilagesRole($paginated=false,$role_id=""){
		 
		$sqlQuery = $this->sql->select()
		->join('access_privileges','access_privileges.role_id='.$this->table.'.role_id',[],Select::JOIN_LEFT)
        ->join('access_resources','access_resources.resource_id=access_privileges.resource_id',['resource_id'=>'resource_id' , 'module', 'controller', 'action', 'idaccessmodules', 'resources_descrept', 'idaccessmode'=>'idaccessmode'],Select::JOIN_LEFT)
		->join('access_modules', 'access_modules.access_module_id=access_resources.idaccessmodules',
		 ['module_descrept', 'module_afficher', 'module_name'],Select::JOIN_LEFT)
		->join('access_mode', 'access_mode.idaccessmode=access_resources.idaccessmode', 
		['labelaccessmode','descaccessmode'],Select::JOIN_LEFT 
		) 
		->order('module_name ASC');

		if(!empty($role_id)){
			$sqlQuery->where("access_roles->role_id=$role_id");
		}
		if($paginated) {
			$classMethod = new ClassMethodsHydrator();
			$entity      = new PrevilegeResourcesEntity();
			$resultSet   = new HydratingResultSet($classMethod, $entity);

			$paginatorAdapter = new DbSelect(
				$sqlQuery,
				$this->adapter,
				$resultSet
			);

			$paginator = new Paginator($paginatorAdapter); 
			return $paginator;
		}

		$sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $handler = $sqlStmt->execute();
 
        $hydrator = new ClassMethodsHydrator();
        $entity = new AccessResourcesEntity();
        $resultSet = new HydratingResultSet($hydrator, $entity);
        $resultSet->initialize($handler);

        return $resultSet;
	}
}