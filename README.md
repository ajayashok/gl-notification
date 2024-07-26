# Notification Manager

A Laravel package for managing notifications through Telegram, WhatsApp, Email and SMS.

## Installation

To install the package, follow these steps:

1. **Install via Composer:**
    ```sh
    composer require gl-package/notification-manager
    ```

2. **Run the migrations:**
    ```sh
    php artisan migrate
    ```

3. **Configure your notification settings** in the `/notification-manager/config` URL.

4. **Publish the configuration files** (optional, only if you need to customize the configuration page):
    ```sh
    php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-views
    php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-controllers
    php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-routes
    ```

5. **Configure the queue** (For Laravel versions prior to 11.0):
    ```sh
    php artisan queue:table
    php artisan migrate
    php artisan queue:work
    ```

6. **Test the URL**: `/notification-manager/send-message/{engine}`
    - Supported Engines: `email`, `telegram`, `whatsapp`, `sms`

## Usage

You can use the notification classes in your Laravel application as follows:

### Telegram Notification

```php
use GlPackage\NotificationManager\Notifications\TelegramNotification;

$data = [
    'message' => "<b>Hello World!</b> Click the button below:",
    'buttons' => [
        [
            ['text' => 'Click Me', 'url' => 'https://example.com'] // Optional
        ]
    ]
];

$telegram = new TelegramNotification();
$telegram->quickSend($data); // For quick send
// or
$telegram->queueSend($data); // For queued send

```

### Email Notification

```php
use GlPackage\NotificationManager\Notifications\EmailNotification;
use Faker\Factory as Faker;

$data = [
    'to_address' => Faker::create()->email,
    'subject' => 'Welcome to Our Service',
    'body' => 'Thank you for signing up! Here are some details about your account.',
    'view' => 'notificationmanager::testmail', // Optional view page location
    'attachments' => [], // Optional attachments array
    'name' => 'Hello, Ajay' // Optional parameters
];

$mail = new EmailNotification();
$mail->send($data); // Send mail via queue
// Ensure to run: php artisan queue:work or use Supervisor
```

### Whatsapp Notification

```php
use GlPackage\NotificationManager\Notifications\WhatsAppNotification;

$data = [
    'mobile' => '91908*******',
    'template' => 'hello_world', // Sample template
    'parameters' => [ // Optional
        [
            "type" => "text",
            "text" => "Test"
        ],
        [
            "type" => "text",
            "text" => "1200"
        ]
    ],
    'buttons' => [ // Optional
        [
            "type" => "text",
            "text" => "16"
        ]
    ]
];

$whatsapp = new WhatsAppNotification();
$whatsapp->send($data); // Send WhatsApp message via queue
// Ensure to run: php artisan queue:work or use Supervisor
```

### SMS Notification

```php
use GlPackage\NotificationManager\Notifications\SMSNotification;
use GuzzleHttp\Client;

$sms = new SMSNotification(new Client());
$sms->send('Hello SMS', '1234567890');
```