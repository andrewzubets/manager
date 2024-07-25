<?php

return [
  'path' => 'public/build/versions.json',
  'is_local' => env('APP_ENV', 'production') === 'local',
  'default' => [
    'js' => [
        'app' => 1
    ],
    'css' => [
        'app' => 1
    ],
  ]
];
