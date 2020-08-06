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

if (!function_exists('api_token')) {

    /**
     * gets logged in users api token from cookie
     *
     * @return string
     */
    function api_token()
    {
        return Cookie::get('api_token');
    }
}

// to be refactored - @doug
if (!function_exists('purify_input')) {

    /**
     * gets logged in users api token from cookie
     *
     * @param string
     * @return string cleaned string
     */
    function purify_input($input)
    {
        return strip_tags($input);
    }
}