<?php
return [
    'endpoint' => env('UPB_WS_API_ENDPOINT', ''),
    'username' => env('UPB_WS_USER', ''),
    'password' => env('UPB_WS_PASSWORD', ''),
    'connect_timeout' =>env('UPB_WS_CONNECT_TIMEOUT', '10'),
    'timeout' =>env('UPB_WS_TIMEOUT', '10'),
];