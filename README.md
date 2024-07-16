# Notification Manager

A Laravel package for managing notifications via Telegram, WhatsApp, SMS, and Email.

## Installation

1. Install the package via Composer:
    ```sh
    composer require gl-package/notification-manager
    ```

2. Publish the configuration file:
    ```sh
    php artisan vendor:publish --provider="GlPackage\NotificationManager\NotificationManagerServiceProvider" --tag=notificationmanager-views
    php artisan vendor:publish --tag=config
    ```

3. Configure your notification settings in the `.env` file.

## Usage

You can now use the notification classes in your Laravel application.

```php
use GlPackage\NotificationManager\Notifications\TelegramNotification;
use GlPackage\NotificationManager\Notifications\WhatsAppNotification;
use GlPackage\NotificationManager\Notifications\SMSNotification;
use GlPackage\NotificationManager\Notifications\EmailNotification;

$telegram = new TelegramNotification(new \GuzzleHttp\Client());
$telegram->send('Hello Telegram');

$whatsapp = new WhatsAppNotification(new \GuzzleHttp\Client());
$whatsapp->send('Hello WhatsApp');

$sms = new SMSNotification(new \GuzzleHttp\Client());
$sms->send('Hello SMS', '1234567890');

$email = new EmailNotification();
$email->send('Hello Email', 'example@example.com');
