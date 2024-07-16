<?php
namespace GlPackage\NotificationManager;

use Illuminate\Support\ServiceProvider;

class NotificationManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Load the routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        
        // Load the views
        $this->loadViewsFrom(__DIR__ . '/views', 'notificationmanager');
        
        // Publish the views
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/notificationmanager'),
        ], 'views');
    }
}