<?php

use Illuminate\Support\Facades\Cookie;

if (!function_exists('DummyFunction')) {

    /**
     * Properly Format money with currency
     *
     * @param number amount 
     * @param string  
     * @return strimg
     */
    function format_money($amount, $currency = null)
    {
        $user_role = Cookie::get('user_role');
        if ($user_role == 'store_admin' || $user_role == 'store_assistant') {
            if (is_numeric($amount)) {
                if ($currency == null) {
                    $currency = (Cookie::get('currency') != '') ? Cookie::get('currency') : 'NGN';
                }
                $format_amount = number_format($amount, 2);
                return $currency . ' ' .$format_amount;
            }
        }
        return $amount;
    }
}
