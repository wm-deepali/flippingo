<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $settingsCache = null;

        try {
            // Check if DB is ready and 'settings' table exists
            if ($settingsCache === null &&
                !app()->runningInConsole() && 
                Schema::hasTable('settings')
            ) {
                $settingsCache = Setting::pluck('value', 'key')->toArray();
            }
        } catch (\Throwable $e) {
            // DB not ready or other error
            return $default;
        }

        return $settingsCache[$key] ?? $default;
    }

}
