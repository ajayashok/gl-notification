<?php

namespace GlPackage\NotificationManager\Http\Controllers;

use GlPackage\NotificationManager\Models\GlNotificationSetting;
use GlPackage\NotificationManager\Notifications\EmailNotification;
use GlPackage\NotificationManager\Notifications\TelegramNotification;
use GlPackage\NotificationManager\Traits\ConfigurationTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use GlPackage\NotificationManager\Notifications\WhatsAppNotification;

class NotificationManagerController
{    
    use ConfigurationTrait;
    
    protected $gl_notification;
    protected $vendorId;

    //create custructor
    public function __construct(GlNotificationSetting $gl_notification){
        $this->gl_notification = $gl_notification;
        $this->vendorId = auth()?->user()?->id;
    }

    public function show()
    {
        $settings = GlNotificationSetting::all(); // Fetch settings from the database
        $object = $this;
        return view('notificationmanager::config', compact('settings','object'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $config = [
            'email' => [
                'enabled' => $this->convertCheckbox($data['email_enabled'] ?? 'off'),
                'smtp_driver' => $data['email_smtp_driver'] ?? '',
                'smtp_host' => $data['email_smtp_host'] ?? '',
                'smtp_port' => $data['email_smtp_port'] ?? '',
                'username' => $data['email_username'] ?? '',
                'password' => $data['email_password'] ?? '',
                'encryption' => $data['email_encryption'] ?? '',
            ],
            'whatsapp' => [
                'enabled' => $this->convertCheckbox($data['whatsapp_enabled'] ?? 'off'),
                'token' => $data['whatsapp_token'] ?? '',
                'waba_id' => $data['waba_id'] ?? ''
            ],
            'telegram' => [
                'enabled' => $this->convertCheckbox($data['telegram_enabled'] ?? 'off'),
                'chat_id' => $data['telegram_chat_id'] ?? '',
                'token' => $data['telegram_token'] ?? '',
            ],
            'sms' => [
                'enabled' => $this->convertCheckbox($data['sms_enabled'] ?? 'off'),
                'api_key' => $data['sms_api_key'] ?? '',
            ],
        ];

        // Save configuration to database or update existing record
        $this->updateConfiguration($config);

        return redirect()->back()->with('success', 'Configuration updated successfully.');
    }

    private function convertCheckbox($value)
    {
        return $value === 'on' ? true : false;
    }

    private function updateConfiguration($config)
    {
        foreach ($config as $key => $settings) {
            GlNotificationSetting::updateOrCreate(
                [
                    'key' => $key,
                ],
                [
                    'vendor_id' => auth()->user()->id ?? session()->getId(),
                    'value' => json_encode($settings)
                ]
            );
            /**
             * OR
             * If you have vendor id , you can choose below code
             */   
            /*  GlNotificationSetting::updateOrCreate(
                    [
                        'vendor_id' => auth()->user()->id ?? session()->getId(),
                        'key' => $key,
                    ],
                    [
                        'value' => json_encode($settings)
                    ]
                ); 
            */  

             //  invalidate Cache
             Cache::forget('get_configuration_'.$key.$this->vendorId);
        }
    }

    public function sendMessage($engine){
        switch ($engine) {
            case 'telegram':
                $data['message'] = "<b>Hello World!</b> Click the button below:";
                $data['buttons'] = [
                    [
                        ['text' => 'Click Me', 'url' => 'https://example.com']
                    ]
                ];
                $sendtelegram  = new TelegramNotification();
                $sendtelegram->quickSend($data); // THis is for quick send
                // $sendtelegram->queueSend($data); // This is for queued send

                return response()->json('Telegram message send successfull');
                break;

            case 'email':
                $data['to_address'] = Faker::create()->email;
                $data['subject'] = 'Welcome to Our Service';
                $data['body'] = 'Thank you for signing up! Here are some details about your account.';
                $data['view'] = 'notificationmanager::testmail'; // Optional view view page location , pass body part only, pass []
                $data['attachments'] = []; // Optional attachments array , using media urls
                $data['name'] = 'Hello, Ajay'; // Optional parameters
                $sendMail  = new EmailNotification();
                $sendMail->send($data); // This is for mail via queue, try to call php artisan queue:work or install supervisor

                return response()->json('Email message send successfull');
                break;

            case 'whatsapp':
                $data['mobile'] = '918089420476';
                $data['template'] = 'reminder4';
                $data['parameters'] = [
                                    [
                                        "type" => "text",
                                        "text" => "AJAY"
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => "1200"
                                    ],
                                    [
                                        "type" => "date_time",
                                        "date_time" => [
                                            "fallback_value" => "2023-07-25"
                                        ]
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

                return response()->json('Whatsapp message send successfull');

                break;
            
            default:
                # code...
                break;
        }
        
    }
}
