<?php

<<<<<<< HEAD
namespace YourVendor\NotificationManager\Config;
=======
namespace GlPackage\NotificationManager\Config;
>>>>>>> b899d1fa71eaf8d99b405b3374cde8545a21f1b3

class ConfigManager
{
    public static function get($service, $key, $default = null)
    {
        return config("notification-manager.{$service}.{$key}", $default);
    }

    public static function isEnabled($service)
    {
        return config("notification-manager.{$service}.enabled", false);
    }
}