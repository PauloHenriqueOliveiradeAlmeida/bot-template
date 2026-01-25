<?php

return [

    'twilio' => [
        'sid' => env('TWILIO_SID', ''),
        'auth_token' => env('TWILIO_AUTH_TOKEN', ''),
    ],
    'gemini' => [
        'base_url' => env('GEMINI_BASE_URL', ''),
        'api_key' => env('GEMINI_API_KEY', ''),
    ]
];
