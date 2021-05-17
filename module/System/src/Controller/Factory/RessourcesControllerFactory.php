<?php

declare(strict_types=1);

namespace System\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface; 
use System\Controller\RessourcesController;

class RessourcesControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new RessourcesController(
			$container->get(Adapter::class) 
		);
	}
}
