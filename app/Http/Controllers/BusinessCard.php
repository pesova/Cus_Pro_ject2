<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PDF;

// use Illuminate\Support\Facades\Http;

class BusinessCard extends Controller
{
    //
    public function card_v1(){
        // $pdf = PDF::loadView('backend.cards.card_v2');
        // return $pdf->download('v3.pdf');
        // die();
        return view('backend.cards.card_v1');
    }

    public function card_v2(){

        return view('backend.cards.card_v2');
    }
}
