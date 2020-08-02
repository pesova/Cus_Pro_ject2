<?php

use Illuminate\Support\Facades\Cookie;

if (!function_exists('is_super_admin')) {

    /**
     * Check if logged in user is a super admin
     *
     * @return boolean
     */
    function is_super_admin()
    {
        if (Cookie::get('user_role') == 'super_admin') {
            return true;
        }
        return false;
    }
}

if (!function_exists('is_store_admin')) {

    /**
     * Check if logged in user is a store admin
     *
     * @return boolean
     */
    function is_store_admin()
    {
        if (Cookie::get('user_role') == 'store_admin') {
            return true;
        }
        return false;
    }
}

if (!function_exists('is_store_assistant')) {

    /**
     * Check if logged in user is a store assistant
     *
     * @return boolean
     */
    function is_store_assistant()
    {
        if (Cookie::get('user_role') == 'store_assistant') {
            return true;
        }
        return false;
    }
}
