<?php

namespace GlPackage\NotificationManager\Notifications;

use GlPackage\NotificationManager\Jobs\SendMessageJob;
use GlPackage\NotificationManager\Services\TelegramService;
use GlPackage\NotificationManager\Traits\ConfigurationTrait;
use Illuminate\Support\Facades\Log;

class TelegramNotification
{
    protected $telegramService;
    protected $getConfiguration;

    use ConfigurationTrait;

    public function __construct()
    {
        $this->telegramService = resolve(TelegramService::class);
        $this->getConfiguration = $this->getConfiguration('telegram');
    }
    public function quickSend($telegramData){
        if(!$this->isEnable())
            return;
        
        try {
            $this->telegramService->sendMessage($this->getConfiguration,$telegramData);
        } catch (\Exception $e) {
            Log::info('Telegraram Message send Error : '.$e->getMessage());
        }
    }
    public function queueSend($telegramData)
    {
        if(!$this->isEnable())
            return;
        
        try {
            // Dispatch the Telegram message job
            SendMessageJob::dispatch($this->telegramService,$this->getConfiguration,$telegramData);
        } catch (\Exception $e) {
            Log::info('Telegraram Message send Error : '.$e->getMessage());
        }
    }

    private function isEnable(){
        return $this->getConfiguration?->enabled;
    }
}
