# Notification Manager

A Laravel package for managing notifications via Telegram, WhatsApp, SMS, and Email.

## Installation

1. Install the package via Composer:
    ```sh
<<<<<<< HEAD
    composer require your-vendor/notification-manager
=======
    composer require gl-package/notification-manager
>>>>>>> b899d1fa71eaf8d99b405b3374cde8545a21f1b3
    ```

2. Publish the configuration file:
    ```sh
<<<<<<< HEAD
 php artisan vendor:publish --tag=config
=======
    php artisan vendor:publish --provider="GlPackage\NotificationManager\NotificationManagerServiceProvider" --tag=notificationmanager-views
    php artisan vendor:publish --tag=config
>>>>>>> b899d1fa71eaf8d99b405b3374cde8545a21f1b3
    ```

3. Configure your notification settings in the `.env` file.

## Usage

You can now use the notification classes in your Laravel application.

```php
<<<<<<< HEAD
use YourVendor\NotificationManager\Notifications\TelegramNotification;
use YourVendor\NotificationManager\Notifications\WhatsAppNotification;
use YourVendor\NotificationManager\Notifications\SMSNotification;
use YourVendor\NotificationManager\Notifications\EmailNotification;
=======
use GlPackage\NotificationManager\Notifications\TelegramNotification;
use GlPackage\NotificationManager\Notifications\WhatsAppNotification;
use GlPackage\NotificationManager\Notifications\SMSNotification;
use GlPackage\NotificationManager\Notifications\EmailNotification;
>>>>>>> b899d1fa71eaf8d99b405b3374cde8545a21f1b3

$telegram = new TelegramNotification(new \GuzzleHttp\Client());
$telegram->send('Hello Telegram');

$whatsapp = new WhatsAppNotification(new \GuzzleHttp\Client());
$whatsapp->send('Hello WhatsApp');

$sms = new SMSNotification(new \GuzzleHttp\Client());
$sms->send('Hello SMS', '1234567890');

$email = new EmailNotification();
$email->send('Hello Email', 'example@example.com');
