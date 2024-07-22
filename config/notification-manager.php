<<<<<<< HEAD
=======
<?php

>>>>>>> b899d1fa71eaf8d99b405b3374cde8545a21f1b3
return [
    'email' => [
        'enabled' => env('EMAIL_ENABLED', false),
        'smtp_server' => env('EMAIL_SMTP_SERVER', ''),
        'username' => env('EMAIL_USERNAME', ''),
        'password' => env('EMAIL_PASSWORD', ''),
    ],
    'whatsapp' => [
        'enabled' => env('WHATSAPP_ENABLED', false),
        'token' => env('WHATSAPP_TOKEN', ''),
        'templates' => []
    ],
    'telegram' => [
        'enabled' => env('TELEGRAM_ENABLED', false),
        'chat_id' => env('TELEGRAM_CHAT_ID', ''),
    ],
    'sms' => [
        'enabled' => env('SMS_ENABLED', false),
        'api_key' => env('SMS_API_KEY', ''),
    ],
];