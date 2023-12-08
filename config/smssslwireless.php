<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Token
    |--------------------------------------------------------------------------
    |
    | API Token is provided by SSL Wireless company, which is a
    | unique key to using the SMS sending gateway service.
    |
    */

    'api_token' => env('API_TOKEN_SSLWIRELESS', null),

    /*
    |--------------------------------------------------------------------------
    | Domain
    |--------------------------------------------------------------------------
    |
    | This domain URL is the endpoint for sending SMS to the gateway,
    | which has been provided by SSL wireless.
    |
    */

    'domain' => env('DOMAIN_SSLWIRELESS', null),

    /*
    |--------------------------------------------------------------------------
    | SID
    |--------------------------------------------------------------------------
    |
    | This is provided by SSL Wireless, which is
    | essential for sending SMS to clients.
    |
    */

    'sid' => env('SID_SSLWIRELESS', null),

];
