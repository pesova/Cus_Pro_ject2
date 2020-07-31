<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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
    public function index($tx_ref)
    {
        $transactionID = $tx_ref;
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
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Invalid Transaction Ref Code');
                return view('backend.payment_details.error');
            }
        } catch (RequestException $e) {
            //throw $th;
            if ($e->getCode() == 404) {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Invalid Transaction Ref Code');
                return view('backend.payment_details.error');
            }
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', 'Invalid Transaction Ref Code');
            return view('backend.payment_details.error');
        }
    }

    /** 
     * show payment form
     */
    public function callback()
    {
        $data = request()->all();

        $status = $data['status'];
        $tx_ref = $data['tx_ref'];
        $transaction_id = $data['transaction_id'];

        try {
            if($status == 'successful'){

            $client = new Client;

                $tranx_verification = $this->host . '/payment/new' . '/' . $transaction_id;

                $tranx_verification_response = $client->request("POST", $tranx_verification);
                $statusCode = $tranx_verification_response->getStatusCode();

                if ($statusCode == 200) {
                    return view('backend.payment_details.success');
                }

            } else {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', $status);
                return view('backend.payment_details.error');
            }
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', 'OOPS something went wrong');
            return view('backend.payment_details.error');
        }
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
