<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $host;

    public function __construct()
    {
        $this->host = env('API_URL', 'https://dev.api.customerpay.me');
    }

    /** 
     * show payment page
     */
    public function index($id)
    {
        $transactionID = $id;
        $transactionURL = $this->host . '/transaction' . '/' . $transactionID;

        $client = new Client;
        try {
            //code...
            $transactionResponse = $client->request("GET", $transactionURL);
            $transacStatusCode = $transactionResponse->getStatusCode();
            
            if ($transacStatusCode == 200) {
                $transaction = json_decode($transactionResponse->getBody())->data->transaction;
                return view('backend.payment_details.index', compact("transaction"));
            } else {
                return ('Invalid Transaction Ref Code');
            }
            
        } catch (RequestException $e) {
            //throw $th;
            return ('Invalid Transaction Ref Code');
        }
    }

    /** 
     * show payment form
     */
    public function create()
    {
        return view('backend.payment_details.create');
    }

    /**
     * Instancitate payment
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number' => 'required',
            'card_expiry_month' => 'required|string|max:2',
            'card_expiry_year' => 'required|string|min:3|max:4',
            'card_cvv_number' => 'required|string|min:3|max:3',
        ]);
        
        $input = $request->all();
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if($validator->passes()) {
            try {
                $request->session()->flash('alert-class', 'alert-info');
                $request->session()->flash('message', 'Work in progress');
                return redirect()->back();
            } catch (\Throwable $th) {
                $request->session()->flash('alert-class', 'alert-dange');
                $request->session()->flash('message', 'something went wrong');
                return redirect()->back();
            }
        }
    }
}
