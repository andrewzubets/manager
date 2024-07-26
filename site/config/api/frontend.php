<?php

return [
  'path' => 'public/build/versions.json',
  'is_local' => false, //env('APP_ENV', 'production') === 'local',
  'default' => [
    'app.js' => 1,
    'app.css' => 1,
  ]
];
