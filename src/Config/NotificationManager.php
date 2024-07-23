<?php

namespace GlPackage\NotificationManager\Config;

class NotificationManager
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