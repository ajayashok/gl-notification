<?php

namespace GlPackage\NotificationManager\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class GlNotificationSetting extends Model
{
    protected $table = 'gl_notification_settings'; // Table name

    // 'vendor_id','type', 'enabled', 'smtp_server', 'username', 'password','token', 'templates', 'chat_id', 'api_key','templates_id','waba_version','waba_id'
    protected $fillable = [
        'vendor_id','key', 'value'
    ];
}
