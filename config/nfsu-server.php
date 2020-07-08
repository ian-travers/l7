<?php

return [
    /*
    |--------------------------------------------------------------------------
    | NFSU Server IP
    |--------------------------------------------------------------------------
    |
    | This value is the of NFSU Server IP for monitoring in your application.
    |
    */
    'ip' => env('NFSU_SERVER_IP', '127.0.0.1'),

    /*
    |--------------------------------------------------------------------------
    | NFSU Server Port
    |--------------------------------------------------------------------------
    |
    | This value is the of NFSU Server PORT for monitoring in your application.
    | Usually it equals 10980.
    |
    */
    'port' => env('NFSU_SERVER_PORT', '10980'),
];
