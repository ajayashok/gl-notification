<?php

namespace GlPackage\NotificationManager\Http\Controllers;

use GlPackage\NotificationManager\Models\GlNotificationSetting;
use Illuminate\Http\Request;

class NotificationManagerController
{
    protected $gl_notification;

    //create custructor
    public function __construct(GlNotificationSetting $gl_notification){
        $this->gl_notification = $gl_notification;
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
                'smtp_server' => $data['email_smtp_server'] ?? '',
                'username' => $data['email_username'] ?? '',
                'password' => $data['email_password'] ?? '',
            ],
            'whatsapp' => [
                'enabled' => $this->convertCheckbox($data['whatsapp_enabled'] ?? 'off'),
                'token' => $data['whatsapp_token'] ?? '',
                'templates' => json_decode($data['whatsapp_templates'], true),
                'waba_version' => $data['waba_version'] ?? '',
                'waba_id' => $data['waba_id'] ?? ''
            ],
            'telegram' => [
                'enabled' => $this->convertCheckbox($data['telegram_enabled'] ?? 'off'),
                'chat_id' => $data['telegram_chat_id'] ?? '',
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
        }
    }

    public function getConfiguration($key)
    {
        $setting = $this->gl_notification->where('key', $key)->first();

        return $setting ? json_decode($setting->value) : null;
    }
}
