<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PDF;

use SnappyImage;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class ReceiptController extends Controller
{
    //

    public function preview(Request $request,$id){
       
        $transaction_details =[
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'transaction_amount' => $request->input('transaction_amount'),
            'transaction_date' => $request->input('transaction_date'),
            'transaction_description' => $request->input('transaction_description'),
            'transaction_id' => $id
        ];
        $image = SnappyImage::loadView('backend.transaction.receipt',[
            "transaction" =>$transaction_details
        ] );
        return $image->inline('transaction_receipt.jpg');
    }

    public function send(Request $request,$id){



    }
    
}
