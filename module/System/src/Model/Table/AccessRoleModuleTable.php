<?php declare(strict_types=1);


namespace System\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;

class AccessRoleModuleTable extends AbstractTableGateway 
{
    protected $adapter;
	protected $table = 'access_rolemodule';
    public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
}