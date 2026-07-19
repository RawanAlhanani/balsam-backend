<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*' , 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // '*' can't be combined safely with supports_credentials below — it lets any
    // site make cookie/token-bearing requests. List real origins instead; set
    // FRONTEND_URL in .env to the deployed React app's origin.
    'allowed_origins' => array_values(array_filter([
        env('FRONTEND_URL'),
        'http://localhost:5173',
        'http://127.0.0.1:5173',
    ])),

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => false,

    'max_age' => false,

    'supports_credentials' => true,

];
