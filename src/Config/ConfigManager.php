<?php

namespace YourVendor\NotificationManager\Config;

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