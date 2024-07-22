# Notification Manager

A Laravel package for managing notifications via Telegram, WhatsApp, SMS, and Email.

## Installation

1. Install the package via Composer:
    ```sh
    composer require your-vendor/notification-manager
    ```

2. Publish the configuration file:
    ```sh
 php artisan vendor:publish --tag=config
    ```

3. Configure your notification settings in the `.env` file.

## Usage

You can now use the notification classes in your Laravel application.

```php
use YourVendor\NotificationManager\Notifications\TelegramNotification;
use YourVendor\NotificationManager\Notifications\WhatsAppNotification;
use YourVendor\NotificationManager\Notifications\SMSNotification;
use YourVendor\NotificationManager\Notifications\EmailNotification;

$telegram = new TelegramNotification(new \GuzzleHttp\Client());
$telegram->send('Hello Telegram');

$whatsapp = new WhatsAppNotification(new \GuzzleHttp\Client());
$whatsapp->send('Hello WhatsApp');

$sms = new SMSNotification(new \GuzzleHttp\Client());
$sms->send('Hello SMS', '1234567890');

$email = new EmailNotification();
$email->send('Hello Email', 'example@example.com');
