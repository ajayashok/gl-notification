<?php
namespace GlPackage\NotificationManager;

use Illuminate\Support\ServiceProvider;

class NotificationManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/notification-manager.php', 'notification-manager');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/notification-manager.php' => config_path('notification-manager.php'),
            ], 'config');
        }
    }
}