<?php
  
  return [
    'DB_CONFIG' => [
      'DB_HOST' => 'localhost',
      'DB_USERNAME' => 'root',
      'DB_PASSWORD' => 'secret',
      'DB_NAME' => 'site'
    ],
    "BACKEND_HOST" => [
      "PROTOCOL" => "HTTP",
      "HOST" => "webhook-mocker.com",
      "WS_HOST" => "ws://webhook-mocker.com",
      "CABINET_URL" => "http://dashboard.webhook-mocker.me/cabinet"
    ]
//    "BACKEND_HOST" => [
//      "PROTOCOL" => "HTTP",
//      "HOST" => "localhost:3000",
//      "WS_HOST" => "ws://localhost:3000",
//      "CABINET_URL" => "http://localhost:4200/cabinet"
//    ]
  ];