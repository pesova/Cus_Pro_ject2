<?php

use Illuminate\Support\Facades\Cookie;

if (!function_exists('app_format_currency')) {
    /**
     * Format currency with logged in user currency
     * @param float $amount amount
     * @param string $currency currency
     * @return string formatted currency
     */
    function app_format_currency($amount, $currency = null)
    {
        if ($currency == null) {
            $currency = (get_user_data('currency') == '') ? get_user_data('currency') : 'NGN';
        }

        $_amount = number_format($amount, 2);
        $formatted = $currency . ' ' . $_amount;
        return $formatted;
    }
}

if (!function_exists('get_user_data')) {
    /**
     * get User info from the cookie
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
