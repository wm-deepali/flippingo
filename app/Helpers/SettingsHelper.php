<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $settingsCache = null;

        if ($settingsCache === null) {
            $settingsCache = Setting::pluck('value', 'key')->toArray();
        }

        return $settingsCache[$key] ?? $default;
    }
}

