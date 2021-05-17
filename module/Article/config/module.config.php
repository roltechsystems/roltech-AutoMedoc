<?php

declare(strict_types=1);



namespace Article;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;


return [
    # les routes ver l'ensemble de fonctionalité de système URL 
    'router' => [
    	'routes' => [
            'Index-Article'=>[
                'type' => Literal::class,
    			'options' => [
    				'route' => '/premier-page',
    				'defaults' => [
    					'controller' => Controller\ArticleController::class,
    					'action' => 'index'
    				],
    			],
            ],
            'Add-Article'=>[
                'type' => Literal::class,
    			'options' => [
    				'route' => '/deuxieme-page',
    				'defaults' => [
    					'controller' => Controller\ArticleController::class,
    					'action' => 'add'
    				],
    			],
            ],
            'info-Article'=>[
                'type' => Literal::class,
    			'options' => [
    				'route' => '/info-page',
    				'defaults' => [
    					'controller' => Controller\ArticleController::class,
    					'action' => 'info-article'
    				],
    			],
            ],
        ],
    ],
    #Metier 
	'controllers' => [
        'factories' => [
            Controller\ArticleController::class => Controller\Factory\ArticleControllerFactory::class,
        ],
    ],
    #Affichage
    'view_manager' => [
    	'template_map' => [ 
            'Index/index'   => __DIR__ . '/../view/Article/index/index.phtml', 
            'Index/add'   => __DIR__ . '/../view/Article/index/add.phtml', 
        ], 
        'template_path_stack' => [
    		'user' => __DIR__ . '/../view'
    	],
    ],
];