<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'soketi' => [
            'driver' => 'pusher',
            'key' => env('WS_APP_KEY', 'app-key'),
            'secret' => env('WS_APP_SECRET', 'app-secret'),
            'app_id' => env('WS_APP_ID', 'app-id'),
            'options' => [
                'host' => env('WS_HOST', '127.0.0.1'),
                'port' => env('WS_PORT', 6001),
                'scheme' => env('WS_SCHEME', 'http'),
                'encrypted' => true,
                'useTLS' => env('WS_SCHEME') === 'https',
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
