<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Registration Options
    |--------------------------------------------------------------------------
    |
    | You may control whether or not registration is possible through the
    | frontend and whether or not you'd like to limit registrations down
    | to a specific email domain (e.g. @yourcompany.com).
    */
    'registration' => [
        
        'enabled' => env('NEWTON_REGISTRATION_ENABLED', true),
        
        'domain' => env('NEWTON_REGISTRATION_DOMAIN', ''),
        
    ]
    
];
