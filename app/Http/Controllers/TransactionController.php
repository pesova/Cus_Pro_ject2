<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
// use GuzzleHttp\Psr7;
// use GuzzleHttp\Psr7\Response;

class TransactionController extends Controller
{
    protected $host;
    protected $api_token;

    public function __construct()
    {
        $this->host = env('API_URL', 'https://dev.api.customerpay.me');
        $this->api_token = Cookie::get('api_token');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transacUrl = $this->host . '/transaction/store_admin';
        $storeUrl = $this->host . '/store';
        $api_token = $this->api_token;

        try {
            $client = new Client;
            $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

            // fetch all stores
            $storeResponse = $client->request("GET", $storeUrl, $payload);
            $storeStatusCode = $storeResponse->getStatusCode();

            // fetch transactions
            $transactionResponse = $client->request("GET", $transacUrl, $payload);
            $transacStatusCode = $transactionResponse->getStatusCode();

            if($storeStatusCode == 200 && $transacStatusCode == 200){
                $stores = json_decode($storeResponse->getBody())->data->stores;
                $transactions = json_decode($transactionResponse->getBody())->data->transactions;

                // dd($transactions);

                return view('backend.transaction.index', compact("stores", "api_token", "transactions"));
            } else if($storeStatusCode == 401 && $transacStatusCode == 401){
                return redirect()->route('login')->with('message', "Please Login Again");
             } 
        } catch (RequestException $e) {

            Log::info('Catch error: LoginController - ' . $e->getMessage());
            // check for 5xx server error
            if ($e->getResponse()->getStatusCode() >= 500) {
                return view('errors.500');
            }
            else {
                return redirect()->route('logout');
           }

        } catch (\Exception $e) {
            //log error;
            Log::error('Catch error: StoreController - ' . $e->getMessage());
            return view('errors.500');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('backend.transaction.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        return view('backend.transaction.report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|max:15',
            'interest' => 'sometimes',
            'description' => 'required|max:150',
            'type' => 'required',
            'customer' => 'required',
            'store' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('transaction.index')->withErrors($validator);
        }
           
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/new';
        $client = new Client();
        $payload = [
            'headers' => ['x-access-token' => Cookie::get('api_token')],
            'form_params' => [
                'amount' => $request->input('amount'),
                'interest' => $request->input('interest'),
                'description' => $request->input('description'),                    
                'type' => $request->input('type'),
                'store_id' => $request->input('store'),
                'customer_id' => $request->input('customer'),
                'expected_pay_date' => $request->input('expected_pay_date'),
            ],
        ];

        try{
            $response = $client->request("POST", $url, $payload);
            $request->session()->flash('alert-class', 'alert-success');
            $request->session()->flash('message', 'Transaction successfully created');
            return redirect()->route('transaction.index');

        }
        catch(ClientException    $e){
                $statusCode = $e->getCode();
            if ($statusCode == 400){
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('message', 'store or customer is not created');
                return redirect()->route('transaction.index');
            }

        }catch (RequestException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            if ($statusCode  == 500) {
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('message', 'Oops! something went wrong, Try Again');
            return redirect()->route('transaction.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('backend.customer.show');
        if ( !$id || empty($id) ) {
            return redirect()->route('dashboard');
        }

        $transaction_id = explode('-', $id)[0];
        $store_id = explode('-', $id)[1];
        $customer_id = explode('-', $id)[2];

        $getTransUrl = $this->host.'/transaction'.'/'.$transaction_id.'/'.$store_id.'/'.$customer_id;
        $storeUrl = $this->host . '/store';
        $customerUrl = $this->host . '/customer';
        $api_token = $this->api_token;
        
        try {
            $client = new Client;
            $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

            // fetch all stores
            $customerResponse = $client->request("GET", $customerUrl, $payload);
            $customerStatusCode = $customerResponse->getStatusCode();

            // fetch single transaction
            $transactionResponse = $client->request("GET", $getTransUrl, $payload);
            $transacStatusCode = $transactionResponse->getStatusCode();

            if($customerStatusCode == 200 && $transacStatusCode == 200){
                $stores = json_decode($customerResponse->getBody())->data->customer;
                $transaction = json_decode($transactionResponse->getBody())->data->transaction;
                // dd($transaction);

                // dd($stores);
                return view('backend.transaction.show', compact("stores", "api_token", "transaction"));
            } else if($customerStatusCode == 401 && $transacStatusCode == 401){
                return redirect()->route('login')->with('message', "Please Login Again");
             } 

        } catch (RequestException $e) {
            // check for  server error
            if ($e->getResponse()->getStatusCode() >= 500) {
                return view('backend.transaction.show')->with('errors.500');
            }
            // get response to catch 4 errors
            $response = json_decode($e->getResponse()->getBody());
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', $response->message);
            return redirect()->route('transaction.index', ['response' => []]);
        } catch (\Exception $e) {

            return view('backend.transaction.index')->with('errors.500');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('backend.transaction.edit');

        // $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/' . $id;

        // // try {
        //     $client = new Client;
        //     $payload = [
        //         'headers' => [
        //             'x-access-token' => Cookie::get('api_token')
        //         ]
        //     ];
        //     $response = $client->request("GET", $url, $payload);
        //     $statusCode = $response->getStatusCode();
        //     $body = $response->getBody();
        //     $TransData = json_decode($body)->data->transaction;
        //     $Storename = json_decode($body)->data->storeName;
        //     $transaction_id = $TransData->_id;
        //     // $changes = [
        //     //     'id' => $transaction_id,
        //     //     'store_name' => $Storename
        //     // ];
        //     if ($statusCode == 200) {

        //         return view('backend.transaction.edit')->with('response', $TransData);
            // }
        // } catch (RequestException $e) {


        //     // check for  server error
        //     if ($e->getResponse()->getStatusCode() >= 500) {
        //         return view('backend.transaction.show')->with('errors.500');
        //     }
        //     // get response to catch 4 errors
        //     $response = json_decode($e->getResponse()->getBody());
        //     Session::flash('alert-class', 'alert-danger');
        //     Session::flash('message', $response->message);
        //     return redirect()->route('transaction.index', ['response' => []]);
        // } catch (\Exception $e) {

        //     return view('backend.transaction.index')->with('errors.500');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $transaction_id = explode('-', $id)[0];
        $store_id = explode('-', $id)[1];
        $customer_id = explode('-', $id)[2];

        // $getTransUrl = $this->host.'/transaction/update'.'/'.$transaction_id.'/'.$store_id.'/'.$customer_id;
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/update/' . $transaction_id;

        
            $client = new Client();


            $request->validate([
                'amount' => 'required|max:15',
                'interest' => 'sometimes',
                'description' => 'required|max:150',
                'type' => 'required',
                'customer' => 'required',
                'store' => 'required',
                'status' => 'required',
            ]);

            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                      'amount' => $request->input('amount'),
                      'interest' => $request->input('interest'),
                      'description' => $request->input('description'),                    
                      'type' => $request->input('type'),
                      'store_id' => $request->input('store'),
                      'customer_id' => $request->input('customer'),
                      'status' => $request->input('status'),
                ],

            ];
            try{

                $res = $client->request("PATCH", $url, $payload);
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Transaction successfully updated');
                return redirect()->route('transaction.index');
    
            }
            catch(ClientException    $e){
                    $statusCode = $e->getCode();
                if ($statusCode == 400){
                    $request->session()->flash('alert-class', 'alert-danger');
                    $request->session()->flash('message', 'some information misisng');
                    return redirect()->route('transaction.index');
                }
    
            }catch (RequestException $e) {
                $res = $e->getResponse();
                $statusCode = $res->getStatusCode();
                if ($statusCode  == 500) {
                    $request->session()->flash('alert-class', 'alert-danger');
                    $request->session()->flash('message', 'Oops! something went wrong, Try Again');
                return redirect()->route('transaction.index');
                }
            }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $transaction_id = explode('-', $id)[0];
        $store_id = explode('-', $id)[1];
        $customer_id = explode('-', $id)[2];

        $getTransUrl = $this->host.'/transaction/delete'.'/'.$transaction_id.'/'.$store_id.'/'.$customer_id;
        // $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/delete/' . $id;
        $client = new Client();
        $payload = [
            'headers' => [
                'x-access-token' => Cookie::get('api_token')
            ]
        ];
        try {
            $delete = $client->delete($getTransUrl, $payload);

            if ($delete->getStatusCode() == 200 || $delete->getStatusCode() == 201) {
                $request->session()->flash('alert-class', 'alert-success');
                session::flash('message', "Transaction successfully deleted");
                return redirect()->route('transaction.index');
            } else if ($delete->getStatusCode() == 401) {
                $request->session()->flash('alert-class', 'alert-danger');
                Session::flash('message', "You are not authorized to perform this action, please check your details properly");
                return redirect()->route('transaction.index');
            } else if ($delete->getStatusCode() == 500) {
                $request->session()->flash('alert-class', 'alert-danger');
                Session::flash('message', "A server error encountered, please try again later");
                return redirect()->route('transaction.index');
            }
        } catch (ClientException $e) {
            $request->session()->flash('alert-class', 'alert-danger');
            Session::flash('message', "A technical error occured, we are working to fix this.");
            return redirect()->route('transaction.index');
        }
    }
}
