<?php

if (!function_exists('setting')) {

    /**
     * Get setting value by key.
     *
     * @param $key
     * @param $default
     *
     * @return string
     */
    function setting($key, $default=null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}
