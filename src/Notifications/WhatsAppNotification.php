<?php

namespace GlPackage\NotificationManager\Notifications;

use GlPackage\NotificationManager\Config\ConfigManager;
use GuzzleHttp\Client;

class WhatsAppNotification
{
    protected $enabled;
    protected $token;
    protected $client;

    public function __construct(Client $client)
    {
        $this->enabled = ConfigManager::isEnabled('whatsapp');
        $this->token = ConfigManager::get('whatsapp', 'token');
        $this->client = $client;
    }

    public function send($message)
    {
        if (!$this->enabled) {
            return;
        }

        // Logic to send WhatsApp notification using Guzzle or any HTTP client
    }
}
