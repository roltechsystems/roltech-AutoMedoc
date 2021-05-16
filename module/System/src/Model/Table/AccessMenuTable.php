<?php

declare(strict_types=1);

namespace System\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this 
use Laminas\Paginator\Adapter\DbSelect; 
use Laminas\Paginator\Paginator;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Select;
 use System\Model\Entity\MenuEntity;

class AccessMenuTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'access_menu';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function getAllMenu($idmodule="",$idsubmenu=""){
		$sqlQuery = $this->sql->select()->order('idaccessmodule ASC');
		$sqlQuery->join("access_modules","access_modules.access_module_id=idaccessmodule",['module_name'])
			->join('access_resources', $this->table.'.resource_id=access_resources.resource_id', [ 'module', 'controller', 'action', 'resources_descrept', 'idaccessmode'],Select::JOIN_LEFT )
			->join('access_mode', 'access_mode.idaccessmode=access_resources.idaccessmode', ['labelaccessmode','descaccessmode'],Select::JOIN_LEFT );
		if(!empty($idmodule)){ 
			$sqlQuery->where("idaccessmodule=$idmodule");
		}
		if(!empty($idsubmenu)){ 
			$sqlQuery->where("submenuid=$idsubmenu");
		}
		$classMethod = new ClassMethodsHydrator();
		$entity      = new MenuEntity();
		$resultSet   = new HydratingResultSet($classMethod, $entity);

		$paginatorAdapter = new DbSelect(
			$sqlQuery,
			$this->adapter,
			$resultSet
		);

		$paginator = new Paginator($paginatorAdapter); 
		return $paginator;
		 
	}

	 
}