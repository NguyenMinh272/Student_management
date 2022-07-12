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

    'facebook' => [
        'client_id' => '837336277243229',
        'client_secret' => 'b2b18d4591cc62006e2214d18ec758a5',
        'redirect' => 'http://localhost:8000/login/callback/facebook'
    ],

    'google' => [
        'client_id' => '137782797593-8elbgbdcldfsqbqvkaf60ilangvlb9m8.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/login/callback/google',
    ],


];
