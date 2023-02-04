<?php

return [

    'poap' => [

        'auth_url' => env('POAP_API_AUTH_URL', 'https://poapauth.auth0.com/oauth/token'),

        'client_id' => env('POAP_API_CLIENT_ID'),
        'client_secret' => env('POAP_API_CLIENT_SECRET'),
        'audience' => env('POAP_API_AUDIENCE'),

        'api_key_cache_id' => env('POAP_API_CACHE_ID', 'poap.api_token'),

    ],

];
