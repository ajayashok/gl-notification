<?php

namespace GlPackage\NotificationManager\Notifications;

use GlPackage\NotificationManager\Config\ConfigManager;
use GuzzleHttp\Client;

class TelegramNotification
{
    protected $enabled;
    protected $token;
    protected $client;

    public function __construct(Client $client)
    {
        $this->enabled = ConfigManager::isEnabled('telegram');
        $this->token = ConfigManager::get('telegram', 'token');
        $this->client = $client;
    }

    public function send($message)
    {
        if (!$this->enabled) {
            return;
        }

        // Logic to send Telegram notification using Guzzle or any HTTP client
    }
}
