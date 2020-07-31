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

        if($status == 'successful'){

            // try {
                $client = new Client;
                $transactionURL = $this->host . '/transaction' . '/' . $tx_ref;
                $transactionResponse = $client->request("GET", $transactionURL);
                $transacStatusCode = $transactionResponse->getStatusCode();
                if ($transacStatusCode == 200) {
                    $transaction = json_decode($transactionResponse->getBody())->data->transaction;
    
                    $tranx_verification = $this->host . '/payment/new' . '/' . $transaction_id;
    
                    $tranx_verification_response = $client->request("POST", $tranx_verification);
                    $statusCode = $tranx_verification_response->getStatusCode();
    
                    if ($statusCode == 200) {
                        $tx_ref_response = json_decode($tranx_verification_response->getBody())->data;
                        $api_key = $tx_ref_response->api_key;

                        dd($tx_ref_response);

                        $storeID = $transaction->store_ref_id;
                        $customerID = $transaction->customer_ref_id;
                        $tranx_message = 'Payment of '.$tx_ref_response->data->currency.' '.$transaction->total_amount.' was successful. Your transaction REF CODE is '.$transaction_id.'';
    
                        // send notification
                        $tranx_notification = $this->host . '/debt/send' . '/' .$storeID.'/'.$customerID.'/'.$tx_ref;
                        $tranx_notification_payload = [
                             'headers' => ['x-access-token' => $api_key],
                             'form_params' => [
                                 'transaction_id' => $tx_ref,
                                 'message' => $tranx_message,
                             ],
                         ];
    
                         $tranx_notification_response = $client->request("POST", $tranx_notification, $tranx_notification_payload);
                         $tranx_notification_status = $tranx_notification_response->getStatusCode();
                         $notification_resp = json_decode($tranx_notification_response->getBody());
                         dd($tranx_notification_response);
                         
                         if ($tranx_notification_status == 200) {
                             Session::flash('alert-class', 'alert-success');
                             Session::flash('message', $notification_resp->message);
                             return view('backend.payment_details.success');
                         } else {
                             Session::flash('alert-class', 'alert-success');
                             Session::flash('message', "Successful");
                             return view('backend.payment_details.success', compact('tranx_message'));
                         }
        
                    } else {
                        Session::flash('alert-class', 'alert-danger');
                        Session::flash('message', 'Oop, Something went wrong!');
                        return view('backend.payment_details.error');
                    }
    
                } else {
                    Session::flash('alert-class', 'alert-danger');
                    Session::flash('message', 'OOPS something went wrong');
                    return view('backend.payment_details.error');
                }
            // } catch (\Throwable $th) {
            //     //throw $th;
            //     Session::flash('alert-class', 'alert-danger');
            //     Session::flash('message', 'OOPS something went wrong');
            //     return view('backend.payment_details.error');
            // }

        } else {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', $status);
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
