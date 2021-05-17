<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Laminas\Db\Adapter;
return [
   'service_manager' => [
        'abstract_factories' => [
            Adapter\AdapterAbstractServiceFactory::class
        ],
        'factories' => [
            Adapter\AdapterInterface::class => Adapter\AdapterServiceFactory::class,
        ],
        'aliases' => [
            Adapter\Adapter::class => Adapter\AdapterInterface::class
        ]
    ],
    'db' => [
        'driver' => \pdo::class,
        'dsn' => 'pgsql:host=localhost;port=5432;dbname=AutoMedoc;user=roltechsystems;password=roltechsystems',
        'user' => 'roltechsystems',
        'pass' => 'roltechsystems',
        'driver_options' => [
            1002 => 'SET NAMES \'UTF8\'',
        ],
        'adapters' => [
            'roltechsystems' => [],
        ],
    ], 
];
