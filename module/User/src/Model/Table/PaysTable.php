<?php

declare(strict_types=1);

namespace User\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;

class PaysTable  extends AbstractTableGateway
{
    protected $adapter;
	protected $table = 'pays';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

    public function getAllPays(){
        return $this->select();
    }
}