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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'facebook' => [
        'client_id' => '479914524031687',  //client face của bạn
        'client_secret' => 'f6d96aec138ec4e5c80f845500a91f0f',  //client app service face của bạn
        'redirect' => 'http://localhost/MyProject/login-admin/callback' //callback trả về
    ],

    'google' => [
        'client_id' => '877630997660-vek8je5ujln38cegso6cr0cjtnpln9h1.apps.googleusercontent.com',  //client face của bạn
        'client_secret' => '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',  //client app service face của bạn
        'redirect' => 'http://localhost/MyProject/google/callback' //callback trả về
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
