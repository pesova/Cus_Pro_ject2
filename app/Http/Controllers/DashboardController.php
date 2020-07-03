<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('backend.dashboard.index');
    }

    public function creditor(){
        return view('backend.creditors.add');
    }
}
