<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        return view('backend.dashboard.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creditor(Request $request)
    { 
        return view('backend.dashboard.creditor');
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analytics(Request $request)
    { 
        return view('backend.dashboard.analytics');
    }

        
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function debt_reminder(Request $request)
    { 
        return view('backend.debtor.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting(Request $request)
    { 
        return view('backend.dashboard.setting');
    }


}
