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

    /**
     * Publish vendor
     * 2. Publish the configuration file: (no need optional)
     * ```sh
     * php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-views
     * php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-config
     * php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-controllers
     * php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-routes
     * php artisan vendor:publish --provider="GlPackage\NotificationManager\Providers\NotificationManagerServiceProvider" --tag=notificationmanager-migrations
     * ```
     *
     * @return void
     */
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
