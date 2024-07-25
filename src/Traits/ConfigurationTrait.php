<?php
namespace GlPackage\NotificationManager\Traits;

use GlPackage\NotificationManager\Models\GlNotificationSetting;
use Illuminate\Support\Facades\Cache;

trait ConfigurationTrait
{
    public function getConfiguration($key,$vendorId = null)
    {
        if(Cache::get('get_configuration_'.$key.$vendorId)){
            $data = Cache::get('get_configuration_'.$key.$vendorId);
        }else{
            $setting = GlNotificationSetting::where('key', $key)->first();

            $data = $setting ? json_decode($setting->value) : null;

            Cache::put('get_configuration_'.$key.$vendorId, $data, null, true);
        }

        return $data;
    }
}
