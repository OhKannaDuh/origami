<?php

return [
    'cache' => [
        'ttl' => 3600,

        'clear' => [
            '/(.*)\.create/' => [
                '$1.all',
                '$1.getById',
                '$1.getByUuid',
                '$1.getByKey',
                '$1.keyExists',
            ],
            '/(.*)\.import/' => [
                '$1.all',
                '$1.getById',
                '$1.getByUuid',
                '$1.getByKey',
                '$1.keyExists',
            ],
        ],

        'actions' => [
            '/(.*)\.all/',
            '/(.*)\.getById/',
            '/(.*)\.getByUuid/',
            '/(.*)\.getByKey/',
            '/(.*)\.keyExists/',
        ],
    ],

    'namespaces' => [
        'model' => 'App\\Models\\',
        'repository' => 'App\\Repositories\\',
    ],
];
