<?php

use GlPackage\NotificationManager\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'GlPackage\NotificationManager\Http\Controllers', 'prefix' => 'notification-manager'], function () {
    Route::controller(ConfigController::class)->group(function()
    {
        Route::get('config','show')->name('notification-manager.config.show');
        Route::post('config','update')->name('notification-manager.config.update');
    });
});
