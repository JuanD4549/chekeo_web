<?php

return [
    'start_path' => base_path('public'),
    'hidden_files' => [
         '.env',
         //'artisan'
        // 'confi/app.php',
        // ...
    ],
    'hidden_folders' => [
        'app',
        'bootstrap',
        'config',
        'database',
        'node_modules',
        'routes',
        'tests',
        'vendor',
        'storage',
        'resources',
        // ...
    ],
];
