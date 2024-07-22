<?php

namespace GlPackage\NotificationManager\Notifications;

use GlPackage\NotificationManager\Config\ConfigManager;
use GuzzleHttp\Client;

class SMSNotification
{
    protected $enabled;
    protected $apiKey;
    protected $client;

    public function __construct(Client $client)
    {
        $this->enabled = ConfigManager::isEnabled('sms');
        $this->apiKey = ConfigManager::get('sms', 'api_key');
        $this->client = $client;
    }

    public function send($message, $number)
    {
        if (!$this->enabled) {
            return;
        }

        // Logic to send SMS using an API client
    }
}
