<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.index');
    }

    public function notification()
    {
        $phone_number = Cookie::get('phone_number');
        $user = User::where('phone_number', $phone_number)->first();
        return view('backend.dashboard.notification')->with([
            'notifications' => $user->notifications,
            'user' => $user
        ]);
    }
    
    public function creditor()
    {
        return view('backend.dashboard.creditor');
    }

    public function analytics()
    {
        return view('backend.dashboard.analytics');
    }
}
