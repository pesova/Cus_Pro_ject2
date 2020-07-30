<?php

use Illuminate\Support\Facades\Cookie;

if (!function_exists('app_format_currency')) {

    function app_format_currency($amount, $currency = 'NGN')
    {
        /**
         * Save User info to the cookie
         * @param string $name name of cookie
         * @return mixed
         */
        $_amount = number_format($amount, 2);
        $formatted = $currency . ' ' . $_amount;
        return $formatted;
    }
}

if (!function_exists('get_user_data')) {
    /**
     * Save User info to the cookie
     * @param string $name name of cookie
     * @return mixed
     */
    function get_user_data($name)
    {
        return Cookie::get($name);
    }
}

if (!function_exists('save_user_data')) {
    /**
     * Save User info to the cookie
     * @param string $name name of cookie
     * @param mixed  $value value to be stored in cookie 
     * @return boolean
     */
    function save_user_data($name, $value = null)
    {
        Cookie::queue($name, $value);
        return true;
    }
}
