# Notification Manager

A Laravel package for managing notifications via Telegram, WhatsApp, SMS, and Email.

## Installation

1. Install the package via Composer:
    ```sh
    composer require gl-package/notification-manager
    ```
2. Configure your notification settings in the `/notification-manager/config` url.

3. Publish the configuration file: (No need, If you want to customise configuration page you can publish)
    ```sh
    php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-views
    php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-controllers
    php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-routes
    ```
4. Run the migrations:
    ```sh
    php artisan migrate
    ```
5. Test the url `/notification-manager/send-message/{engine}`.            NB: `engines : mail, telegram, whatsapp. sms`

## Usage

You can now use the notification classes in your Laravel application.

```php
use GlPackage\NotificationManager\Notifications\TelegramNotification;
use GlPackage\NotificationManager\Notifications\WhatsAppNotification;
use GlPackage\NotificationManager\Notifications\SMSNotification;


/* ----------- Telegram message --------- */
$data['message'] = "<b>Hello World!</b> Click the button below:";
$data['buttons'] = [
    [
        ['text' => 'Click Me', 'url' => 'https://example.com'] // Optional ,if you dont want to include button you can pass $data['buttons'] =  [] array.
    ]
];
$sendtelegram  = new TelegramNotification();
$sendtelegram->quickSend($data); // THis is for quick send
// $sendtelegram->queueSend($data); // This is for queued send

/* ----------Email message--------- */
$data['to_address'] = Faker::create()->email;
$data['subject'] = 'Welcome to Our Service';
$data['body'] = 'Thank you for signing up! Here are some details about your account.';
$data['view'] = 'notificationmanager::testmail'; // Optional view view page location , pass body part only, pass []
$data['attachments'] = []; // Optional attachments array , using media urls
$data['name'] = 'Hello, Ajay'; // Optional parameters
$sendMail  = new EmailNotification();
$sendMail->send($data); // This is for mail via queue, try to call php artisan queue:work or install supervisor

/* ----------Whatsapp message */
$data['mobile'] = '91908*******';
$data['template'] = 'hello_world'; // sample

`parameters and buttons` are optional . You can pass [] array to these field.

$data['parameters'] = [
                    [
                        "type" => "text",
                        "text" => "Test"
                    ],
                    [
                        "type" => "text",
                        "text" => "1200"
                    ]
                ];
$data['buttons'] = [
                [
                    "type" => "text",
                    "text" => "16"
                ]
            ];

$sendWhatsapp  = new WhatsAppNotification();
$sendWhatsapp->send($data); // This is for whatsApp message via queue, try to call php artisan queue:work or install supervisor

$sms = new SMSNotification(new \GuzzleHttp\Client());
$sms->send('Hello SMS', '1234567890');

