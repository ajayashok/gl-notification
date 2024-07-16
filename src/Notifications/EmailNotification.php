<?php

namespace GlPackage\NotificationManager\Notifications;

use GlPackage\NotificationManager\Config\ConfigManager;
use Illuminate\Support\Facades\Mail;

class EmailNotification
{
    protected $enabled;
    protected $smtpServer;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->enabled = ConfigManager::isEnabled('email');
        $this->smtpServer = ConfigManager::get('email', 'smtp_server');
        $this->username = ConfigManager::get('email', 'username');
        $this->password = ConfigManager::get('email', 'password');
    }

    public function send($message, $to)
    {
        if (!$this->enabled) {
            return;
        }

        // Logic to send Email using Laravel's Mail facade
    }
}
