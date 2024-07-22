<?php
namespace GlPackage\NotificationManager\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/notificationmanager.php', 'notificationmanager'
        );
    }

    public function boot()
    {       
        // Load the routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        
        // Load the views
        $this->loadViewsFrom(__DIR__ . '/views', 'notificationmanager');
        
        // Publish views
        $this->publishes([
            __DIR__.'/../views' => resource_path('views/notificationmanager'),
        ], 'notificationmanager-views');

        // Publish config
        $this->publishes([
            __DIR__.'/../Config/notificationmanager.php' => config_path('notificationmanager.php'),
        ], 'notificationmanager-config');

        // Publish controllers
        $this->publishes([
            __DIR__.'/../Controllers' => app_path('Http/Controllers/NotificationManager'),
        ], 'notificationmanager-controllers');
        
        // Publish routes
        $this->publishes([
            __DIR__.'/../routes/web.php' => base_path('routes/notificationmanager.php'),
        ], 'notificationmanager-routes');
    }
}