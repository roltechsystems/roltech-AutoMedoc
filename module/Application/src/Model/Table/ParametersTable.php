<?php

declare(strict_types=1);

namespace Application\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
  


class ParametersTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'parameters';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
}