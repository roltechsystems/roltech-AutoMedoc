<?php

declare(strict_types=1);

namespace System\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this 
use Laminas\Db\Sql\Select;
use System\Model\Entity\ModulesEntity;
use Laminas\Paginator\Paginator;

class AccessModulesTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'access_modules';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	} 

	public function getAllModules(){
		$sqlQuery = $this->sql->select()->order('role_id ASC');

	 
		$classMethod = new ClassMethodsHydrator();
		$entity      = new ModulesEntity();
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