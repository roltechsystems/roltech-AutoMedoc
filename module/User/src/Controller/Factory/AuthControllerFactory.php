<?php

declare(strict_types=1);

namespace User\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\AuthController;
use User\Model\Table\UsersTable;

class AuthControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new AuthController(
			$container->get(Adapter::class),
			$container->get(UsersTable::class)
		);
	}
}
