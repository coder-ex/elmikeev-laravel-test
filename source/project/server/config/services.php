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

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'amocrm' => [
        'integration_id' => '3917eb62-f1e8-49f3-805f-60b0282f4721',
        'secret_key' => 'fBliBlIr0fL05AR3b5e75OIRsiRoB50tgKJU1XaaZZ7vwpaBOCHGo6tMp8XIPAOv',
        'redirect_url' => 'https://kkw70.makeroi.ru',
        'domain' => 'coderex.amocrm.ru',
    ]
];
