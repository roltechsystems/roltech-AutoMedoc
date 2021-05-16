<?php

declare(strict_types=1);

namespace System\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this 
 


class AccessModeTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'access_mode';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	 

	 
}