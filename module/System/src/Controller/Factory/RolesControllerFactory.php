<?php

declare(strict_types=1);

namespace System\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface; 
use System\Controller\RolesController;

class RolesControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new RolesController(
			$container->get(Adapter::class) 
		);
	}
}
