<?php

declare(strict_types=1);

namespace Article\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Article\Controller\ArticleController;
 

class ArticleControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
        
		return new ArticleController($container);
	}
}
