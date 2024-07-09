<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'ip_info' => [
        // 'provider' => env('IP_INFO_PROVIDER', \App\Providers\IpInfo\IpApiIsProvider::class),
        'provider' => env('IP_INFO_PROVIDER', \App\Providers\IpInfo\IpApiComProvider::class),
        // 'provider' => env('IP_INFO_PROVIDER', \App\Providers\IpInfo\IpApiCoProvider::class),
        // 'provider' => env('IP_INFO_PROVIDER', \App\Providers\IpInfo\IpInfoIoProvider::class),
        // 'provider' => env('IP_INFO_PROVIDER', \App\Providers\IpInfo\Ip2LocationProvider::class),
        // 'provider' => env('IP_INFO_PROVIDER', \App\Providers\IpInfo\IpWhoIsProvider::class),
        'cache' => env('IP_INFO_CACHE', 3600), // ttl in seconds, 0 or false - disable cache
        'cache_prefix' => env('IP_INFO_CACHE_PREFIX', 'ip_info::'),
        'localhost_debug' => env('IP_INFO_LOCALHOST_DEBUG', '8.8.8.8'), // false for disables localhost debugging
    ],

    'weather_info' => [
        'cache' => env('WEATHER_INFO_CACHE', true), // true or false
        'cache_prefix' => env('WEATHER_INFO_CACHE_PREFIX', 'weather_info::'),
        'api_key' => [
            'stormglass' => env('WEATHER_INFO_API_KEY_STORMGLASS', '7822ac0a-30e7-11ef-9acf-0242ac130004-7822aca0-30e7-11ef-9acf-0242ac130004'),
        ],
    ],
];
