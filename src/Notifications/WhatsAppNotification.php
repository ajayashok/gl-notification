<?php

namespace GlPackage\NotificationManager\Notifications;

use GlPackage\NotificationManager\Jobs\SendMessageJob;
use GlPackage\NotificationManager\Traits\ConfigurationTrait;
use GlPackage\NotificationManager\Services\WhatsappService;
use Illuminate\Support\Facades\Log;

class WhatsAppNotification
{
    protected $whatsappService;
    protected $getConfiguration;

    use ConfigurationTrait;

    public function __construct()
    {
        $this->whatsappService = resolve(WhatsappService::class);
        $this->getConfiguration = $this->getConfiguration('whatsapp');
    }

    public function send($data)
    {
        if(!$this->isEnable())
            return 'Whatsapp Configuration not enabled';

        try {
            $this->whatsappService->sendMessage($this->getConfiguration,$data);
                        // or
            // Dispatch the Whatsapp message job
            // SendMessageJob::dispatch($this->whatsappService,$this->getConfiguration,$data);
        } catch (\Exception $e) {
            Log::info('Telegraram Message send Error : '.$e->getMessage());
        }
    }
}
