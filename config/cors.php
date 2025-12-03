<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000', 'http://localhost:8000'],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
