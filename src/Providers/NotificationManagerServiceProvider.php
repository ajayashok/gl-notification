<?php
namespace GlPackage\NotificationManager\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        // $this->mergeConfigFrom(
        //     __DIR__.'/../Config/NotificationManager.php', 'notificationmanager'
        // );
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }

    public function boot()
    {
        // Load migrations from the package
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        // Load the routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load the views
        $this->loadViewsFrom(__DIR__ . '/../views', 'notificationmanager');

        // Publish views
        $this->publishes([
            __DIR__.'/../views' => resource_path('views/notification-manager'),
        ], 'notificationmanager-views');

        // Publish config
        $this->publishes([
            __DIR__.'/../Config/NotificationManager.php' => config_path('notificationmanager.php'),
        ], 'notificationmanager-config');

        // Publish controllers
        $this->publishes([
            __DIR__.'/../Http/Controllers' => app_path('Http/Controllers/NotificationManager'),
        ], 'notificationmanager-controllers');

        // Publish routes
        $this->publishes([
            __DIR__.'/../routes/web.php' => base_path('routes/notificationmanager.php'),
        ], 'notificationmanager-routes');

        // Optionally, you can publish the migrations to the application's migration directory
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'notificationmanager-migrations');
    }
}
