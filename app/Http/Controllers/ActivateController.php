<?php

namespace App\Http\Controllers;

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
        return view('backend.user.activate')->with([
                'apiToken' => Cookie::get('apiToken'),
                'phoneNumber' => Cookie::get('phone_number')
           ]);
    }

}
