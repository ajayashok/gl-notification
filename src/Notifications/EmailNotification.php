<?php

namespace GlPackage\NotificationManager\Notifications;

use GlPackage\NotificationManager\Jobs\SendMessageJob;
use GlPackage\NotificationManager\Services\EmailService;
use GlPackage\NotificationManager\Traits\ConfigurationTrait;
use Illuminate\Support\Facades\Log;

class EmailNotification
{
    protected $emailService;
    protected $getConfiguration;

    use ConfigurationTrait;

    public function __construct()
    {
        $this->emailService = resolve(EmailService::class);
        $this->getConfiguration = $this->getConfiguration('email');
    }
    public function send($data)
    {
        if(!$this->isEnable())
            return 'Email Configuration not enabled';
        
        try {
            try {
                // Dispatch the Telegram message job
                SendMessageJob::dispatch($this->emailService,$this->getConfiguration,$data);
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }

        } catch (\Exception $e) {
            Log::info('Email Message send Error : '.$e->getMessage());
        }
    }
}
