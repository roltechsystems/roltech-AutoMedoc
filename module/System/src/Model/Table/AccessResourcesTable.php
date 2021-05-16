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

class AccessResourcesTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'access_resources';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
	public function fetchAllReressource($paginated=false,$module_id="",$mode_id=""){
		 
		$sqlQuery = $this->sql->select()
		->join('access_modules', 'access_modules.access_module_id='.$this->table.'.idaccessmodules',
		 ['module_descrept', 'module_afficher', 'module_name'],Select::JOIN_LEFT)
		->join('access_mode', 'access_mode.idaccessmode='.$this->table.'.idaccessmode', 
		['labelaccessmode','descaccessmode'],Select::JOIN_LEFT 
		)
		->columns(['resource_id'=>'resource_id' , 'module', 'controller', 'action', 'idaccessmodules', 'resources_descrept', 'idaccessmode'=>'idaccessmode'])
		->order('module_name ASC');

		if(!empty($module_id)){
			$sqlQuery->where("access_modules.access_module_id=$module_id");
		}

		if(!empty($mode_id)){
			$sqlQuery->where("access_mode.idaccessmode='$mode_id'");
		}


		if($paginated) {
			$classMethod = new ClassMethodsHydrator();
			$entity      = new AccessResourcesEntity();
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
	 
	public function saveRessource($data){

		$this->insert($data);
	}
	 
}