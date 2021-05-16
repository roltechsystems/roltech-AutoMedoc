<?php

declare(strict_types=1);

namespace User;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
    	'routes' => [
            'navigation' => [
    			'type' => Literal::class,
    			'options' => [
    				'route' => '/navigation',
    				'defaults' => [
    					'controller' => Controller\NavigationController::class,
    					'action' => 'navigationadmin'
    				],
    			],
    		],
    		'signup' => [
    			'type' => Literal::class,
    			'options' => [
    				'route' => '/signup',
    				'defaults' => [
    					'controller' => Controller\AuthController::class,
    					'action' => 'create'
    				],
    			],
    		],
            'login' => [
                'type' => Segment::class, # change route type from Literal to Segment
                'options' => [
                    'route' => '/login[/:returnUrl]',
                    'constraints' => [
                        'returnUrl' => '[a-zA-Z][a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'loginadmin' => [
                'type' => Segment::class, # change route type from Literal to Segment
                'options' => [
                    'route' => '/login-admin[/:returnUrl]',
                    'constraints' => [
                        'returnUrl' => '[a-zA-Z][a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'login-admin'
                    ],
                ],
            ],
            'profile' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/profile',
                    'defaults' => [
                        'controller' => Controller\ProfileController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'actions-profile' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/:action[/:id]',
                            'controller' => Controller\ProfileController::class,
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9_-]*',
                            ],
                        ],
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => Controller\LogoutController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'forgot' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/forgot',
                    'defaults' => [
                        'controller' => Controller\PasswordController::class,
                        'action' => 'forgot'
                    ],
                ],
            ],
            'reset' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/reset[/:id[/:token]]',
                    'constraints' => [
                        'id' => '[0-9]+',
                        'username' => '[a-zA-Z][a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PasswordController::class,
                        'action' => 'reset'
                    ],
                ],
            ],
            'settings' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/settings[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\SettingController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'admin_user' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin/user[/:action[/:id[/page[/:page]]]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',

                    ],
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action' => 'index'
                    ],
                ],
            ],
    	],
    ],
    'controllers' => [
    	'factories' => [
            Controller\AdminController::class => Controller\Factory\AdminControllerFactory::class,
    		Controller\AuthController::class => Controller\Factory\AuthControllerFactory::class,
            Controller\LoginController::class => Controller\Factory\LoginControllerFactory::class,
            Controller\LogoutController::class => InvokableFactory::class,
            Controller\PasswordController::class => Controller\Factory\PasswordControllerFactory::class, 
            Controller\ProfileController::class => Controller\Factory\ProfileControllerFactory::class,
            Controller\SettingController::class => Controller\Factory\SettingControllerFactory::class,
            Controller\NavigationController::class => Controller\Factory\NavigationControllerFactory::class,
        ],
    ],
    'view_manager' => [
    	'template_map' => [

            /** admin template map */
            'admin/index'   => __DIR__ . '/../view/user/admin/index.phtml', 
            /** auth template map */
    		'auth/create'   => __DIR__ . '/../view/user/auth/create.phtml',
            'login/index'   => __DIR__ . '/../view/user/auth/login.phtml', 
            'login/login-admin-layout'   => __DIR__ . '/../../../layouts/adminlte3/layout/login.phtml', 

            'login/index-layout'   => __DIR__ . '/../Layout/auth/login.phtml', 

            
            'login/login-admin'   => __DIR__ . '/../view/user/auth/login-admin.phtml', 

            'password/forgot' => __DIR__ . '/../view/user/auth/forgot.phtml',
            'password/reset' => __DIR__ . '/../view/user/auth/reset.phtml',            
            'profile/index' => __DIR__ . '/../view/user/profile/index.phtml',
            # settings template map
            'setting/delete' => __DIR__ . '/../view/user/setting/delete.phtml',
            'setting/email' => __DIR__ . '/../view/user/setting/email.phtml',
            'setting/index' => __DIR__ . '/../view/user/setting/index.phtml',
            'setting/password' => __DIR__ . '/../view/user/setting/password.phtml',
            'setting/username' => __DIR__ . '/../view/user/setting/username.phtml',

            #Menu navigation
            'Navigation/Navigation-layout'   => __DIR__ . '/../../../layouts/adminlte3/layout/accueil.phtml', 
            'Navigation/admin'   => __DIR__ . '/../view/user/navigation/admin.phtml', 
    	],
    	'template_path_stack' => [
    		'user' => __DIR__ . '/../view'
    	]
    ],
    'translator' => [
        'locale' => 'fr_FR',
        'translation_file_patterns' => [
            [
                'type' => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.php',
            ],
        ],
    ],
];
