<?php

return [
    // route alias
    'route_alias' => [
        'api' => env('API_ALIAS', 'api/v1'),
        'frontend' => env('FRONTEND_ALIAS', '/'),
        'backend' => env('BACKEND_ALIAS', 'admin'),
        'agent' => env('AGENT_ALIAS', 'agent'),
    ],
];
