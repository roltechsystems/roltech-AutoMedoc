<?php

declare(strict_types=1);

namespace System\Model\Table;

use Laminas\Db\Adapter\Adapter; 
use Laminas\Db\TableGateway\AbstractTableGateway;  

class AccessPrivilegesTable  extends AbstractTableGateway
{
    protected $adapter;
	protected $table = 'access_privileges';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
    public function fetchResourcesByRole($roleid,$moduleParam=null)
    {
        $sqlQuery = $this->sql->select()
            ->join('access_resources', 'access_resources.resource_id='.$this->table.'.resource_id',
             ['module', 'controller', 'action'])
            ->join('access_roles', 'access_roles.role_id='.$this->table.'.role_id', 'role_name');
		if(!empty($moduleParam)){
			$sqlQuery->where(['access_roles.role_id'=>$roleid,'idaccessmodules'=>$moduleParam]);
		}else{
			$sqlQuery->where(['access_roles.role_id'=>$roleid]);
		}
            
        $sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $handler = $sqlStmt->execute(); 
        
        return $handler;
    }
     
}