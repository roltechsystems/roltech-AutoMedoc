<?php

declare(strict_types=1);

namespace System;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
    	'routes' => [
            'MesModules'=>[
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/system/modules',
                    'defaults' => [
                        'controller' => Controller\AppmodulesController::class,
                        'action' => 'index',
                    ],
                ],
                'child_routes' => [
                    'actions-modules' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/edit[/:id]', 
                            'defaults' => [ 
                                'action' => 'edit',
                            ], 
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-modules-lister' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/lister[/:id]', 
                            'defaults' => [ 
                                'action' => 'index',
                            ], 
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-modules-save' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/save[/:id]', 
                            'defaults' => [ 
                                'action' => 'save',
                            ], 
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-modules-delete' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/delete[/:id]', 
                            'defaults' => [ 
                                'action' => 'delete',
                            ], 
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                ],
            ],
            'roles' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/system/roles',
                    'defaults' => [
                        'controller' => Controller\RolesController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'actions-role' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/edit[/:id]', 
                            'defaults' => [ 
                                'action' => 'edit',
                            ], 
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-role-tree' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/tree[/:id]', 
                            'defaults' => [ 
                                'action' => 'tree-role',
                            ], 
                            'constraints' => [ 
                                'id' => '[0-9_-]*',
                            ],
                        ], 
                    ],
                    'actions-role-management' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/management[/:id]', 
                            'defaults' => [ 
                                'action' => 'gestion-role',
                            ], 
                            'constraints' => [ 
                                'id' => '[0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-role-save' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/enregistrer[/:id]', 
                            'defaults' => [ 
                                'action' => 'save-role',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ], 
                    'actions-role-delete' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/delete[/:id]', 
                            'defaults' => [ 
                                'action' => 'delete-role',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                ],
    		],
            'ressources' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/system/ressources',
                    'defaults' => [
                        'controller' => Controller\RessourcesController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'actions-ressources' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/edit[/:id]', 
                            'defaults' => [ 
                                'action' => 'edit',
                            ], 
                            'constraints' => [ 
                                'id' => '[0-9_-]*',
                            ],
                        ],
                    ], 
                    'actions-ressources-select-option' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/select-options[/:module]', 
                            'defaults' => [ 
                                'action' => 'getoption-ressource',
                            ], 
                            'constraints' => [ 
                                'module' => '[0-9_-]*',
                            ],
                        ],
                    ], 
                    'actions-ressources-save' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/save[/:id]', 
                            'defaults' => [ 
                                'action' => 'save-ressources',
                            ], 
                            'constraints' => [ 
                                'id' => '[0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-ressources-delete' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/delete[/:id]', 
                            'defaults' => [ 
                                'action' => 'delete-ressource',
                            ], 
                            'constraints' => [ 
                                'id' => '[0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-ressources-filter' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/filter[/:module][/:mode]', 
                            'defaults' => [ 
                                'action' => 'filter-module',
                            ], 
                            'constraints' => [ 
                                'module' => '[a-zA-Z0-9_-]*',
                                'mode' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-ressources-tree' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/tree[/:id]', 
                            'defaults' => [ 
                                'action' => 'tree-ressources',
                            ], 
                            'constraints' => [ 
                                'id' => '[0-9_-]*',
                            ],
                        ], 
                    ],
                    'actions-ressources-management' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/management[/:id]', 
                            'defaults' => [ 
                                'action' => 'gestion-ressources',
                            ], 
                            'constraints' => [ 
                                'id' => '[0-9_-]*',
                            ],
                        ],
                    ],    



                ],
            ],  
            'droits' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/system/droit',
                    'defaults' => [
                        'controller' => Controller\PrivilegeController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'actions-droit' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/edit[/:role]', 
                            'defaults' => [ 
                                'action' => 'edit',#multiple droit + module + mode
                            ], 
                            'constraints' => [ 
                                'role' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                    'actions-assigne' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/assigne[/:role][/:module]', 
                            'defaults' => [ 
                                'action' => 'assigne-droit',
                            ], 
                            'constraints' => [ 
                                'role' => '[a-zA-Z0-9_-]*',
                                'module' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ], 
                    'actions-assigne-module' => [
                        'type' => \Laminas\Router\Http\Literal::class,
                        'options' => [
                            'route' => '/signemodule', 
                            'defaults' => [ 
                                'action' => 'assigner-mode-module',
                            ],  
                        ],
                    ], 
                    'actions-assigne-update' => [
                        'type' => \Laminas\Router\Http\Literal::class,
                        'options' => [
                            'route' => '/update', 
                            'defaults' => [ 
                                'action' => 'update-privilege',
                            ],  
                        ],
                    ],
                ],
            ],  
            #Gestion des menu
            'menu' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/system/menu',
                    'defaults' => [
                        'controller' => Controller\MenuController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'actions-menu-tree' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/tree-menu', 
                            'defaults' => [ 
                                'action' => 'tree-menu',
                            ],  
                        ],
                    ],
                    'actions-menu-management' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/management', 
                            'defaults' => [ 
                                'action' => 'gestion-menu',
                            ],  
                        ],
                    ],
                    'actions-menu-save' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/save-menu[/:id]', 
                            'defaults' => [ 
                                'action' => 'save-menu',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*', 
                            ],
                        ],
                    ],
                    'actions-menu-lister' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/lister-menu[/:module][/:idsubmenu]', 
                            'defaults' => [ 
                                'action' => 'index',
                            ],
                            'constraints' => [ 
                                'module' => '[0-9]*', 
                                'idsubmenu'=>'[0-9]*',
                            ],  
                        ],
                    ],
                    'actions-menu-add' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/add-menu[/:module][/:id]', 
                            'defaults' => [ 
                                'action' => 'add-menu',
                            ],
                            'constraints' => [ 
                                'module' => '[0-9]*', 
                                'id'=>'[0-9]*',
                            ],  
                        ],
                    ],
                    'actions-menu-add-sub' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/add-sub-menu[/:module][/:idsubmenu]', 
                            'defaults' => [ 
                                'action' => 'add-menu',
                            ],
                            'constraints' => [ 
                                'module' => '[0-9]*', 
                                'idsubmenu'=>'[0-9]*',
                            ],  
                        ],
                    ],
                    'actions-menu-delete' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/delete-menu[/:id]', 
                            'defaults' => [ 
                                'action' => 'delete-menu',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*', 
                            ],
                        ],
                    ],
                    'actions-menu-menu' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/menu-menu[/:module][/:id]', 
                            'defaults' => [ 
                                'action' => 'menu-menu',
                            ],
                            'constraints' => [ 
                                'module' => '[0-9]*', 
                                'id'=>'[0-9]*',
                            ],  
                        ],
                    ],
                    'actions-menu-module' => [
                        'type' => \Laminas\Router\Http\Segment::class,
                        'options' => [
                            'route' => '/menu-module[/:module]', 
                            'defaults' => [ 
                                'action' => 'menu-module',
                            ],
                            'constraints' => [ 
                                'module' => '[0-9]*',
                            ],  
                        ],
                    ],
                ],
            ],
    	],
    ],
    'controllers' => [
    	'factories' => [
            Controller\AdminController::class => InvokableFactory::class, 
            Controller\RessourcesController::class=> Controller\Factory\RessourcesControllerFactory::class,
            Controller\PrivilegeController::class=> Controller\Factory\PrivilegeControllerFactory::class,
            Controller\RolesController::class=> Controller\Factory\RolesControllerFactory::class,
            Controller\AppmodulesController::class=> Controller\Factory\AppmodulesControllerFactory::class,
            Controller\MenuController::class=> Controller\Factory\MenuControllerFactory::class,


        ],
    ],
    'view_manager' => [
    	'template_map' => [ 
            'system/layout'  => __DIR__ . '/../../../layouts/adminlte3/layout/layout.phtml', 

            #ressources
            'system/add-ressources'   => __DIR__ . '/../view/system/ressources/add.phtml', 
            'system/lister-ressources'   => __DIR__ . '/../view/system/ressources/lister.phtml', 
            'system/tree-ressources-management'   => __DIR__ . '/../view/system/ressources/ressourcestree.phtml', 
            'system/menu-ressources-management' => __DIR__ . '/../view/system/ressources/menu-gestion-ressources.phtml',

            
            #Roles
            'system/tree-role-management'   => __DIR__ . '/../view/system/roles/rolestree.phtml', 
            'system/add-role'   => __DIR__ . '/../view/system/roles/add.phtml', 
            'system/lister-role'   => __DIR__ . '/../view/system/roles/lister.phtml', 
            'system/menu-role-management' => __DIR__ . '/../view/system/roles/menu-gestion-role.phtml', 
            
            #doit Privilége
            'system/add-droit'   => __DIR__ . '/../view/system/privilege/add.phtml', 
            'system/lister-droit'   => __DIR__ . '/../view/system/privilege/lister.phtml', 
            'system/assigne-droit'   => __DIR__ . '/../view/system/privilege/assigne-droit.phtml',
            'system/update-privilege'   => __DIR__ . '/../view/system/privilege/update-privilege.phtml', 


            #modules
            'system/add-modules'   => __DIR__ . '/../view/system/modules/add.phtml', 
            'system/lister-modules'   => __DIR__ . '/../view/system/module/lister.phtml', 


            #commun json 
            'communjson/json-view'   => __DIR__ . '/../view/system/communjson/jsonview.phtml', 


            #menu
            'menu/tree-menu-management'   => __DIR__ . '/../view/system/menu/menutree.phtml', 
            'menu/menu-menu'   => __DIR__ . '/../view/system/menu/menu-menu.phtml',  
            'menu/menu-add'   => __DIR__ . '/../view/system/menu/add.phtml', 
            'menu/menu-lister'   => __DIR__ . '/../view/system/menu/lister.phtml', 
            'menu/menu-module'   => __DIR__ . '/../view/system/menu/menu-module.phtml', 


    	],
    	'template_path_stack' => [
    		'system' => __DIR__ . '/../view'
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
