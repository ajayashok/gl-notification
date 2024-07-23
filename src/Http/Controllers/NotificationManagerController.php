<?php

namespace GlPackage\NotificationManager\Http\Controllers;

use Illuminate\Http\Request;

class NotificationManagerController
{
    public function show()
    {
        return view('notificationmanager::config');
    }

    public function update(Request $request)
    {
        // Validate and save the configuration data
        // Logic to update the .env file or the config file
    }
}
