<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    //
   public function dash (Request $request) {
        $token = $request->cookie('api_token');
        $response = Http::get( 'https://dev.customerpay.me/transaction/all', ['api_token' => $token]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $transactions = json_decode($body);
        if ($statusCode === 200){
            return view('backend.dashboard')->with(['transactions' => $transactions]);

        }else{
            //return 404 page
            return view('errors.404');
        }
        
    
    }
}
