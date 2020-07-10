<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class ActivateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Cookie::get('is_active')) {
            return redirect()->route('dashboard');
        }
        return view('backend.user.activate')->with([
            'apiToken' => Cookie::get('api_token'),
            'phoneNumber' => Cookie::get('phone_number')
        ]);
    }

    public function activate(Request $request)
    {
        Cookie::queue('is_active', true);
        if ($request->has('skip')) {
            return redirect()->route('dashboard');
        }
        return 'done'; // this method will be called via ajax. returning "done" is just a placeholder text for the callback function of the calling script
    }

}
