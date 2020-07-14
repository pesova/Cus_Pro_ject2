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
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

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
        $transacUrl = $this->host . '/transaction';
        $storeUrl = $this->host . '/store';
        $customerUrl = $this->host . '/customer';
        $api_token = $this->api_token;

        try {
            $client = new Client;
            $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

            // fetch all stores
            $storeResponse = $client->request("GET", $storeUrl, $payload);
            $statusCode = $storeResponse->getStatusCode();
            if($statusCode == 200){
                $body = $storeResponse->getBody();
                $stores = json_decode($storeResponse->getBody())->data->stores;
                return view('backend.transaction.index', compact("stores", "api_token"));
            } else if($statusCode == 401){
                return redirect()->route('logout');
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
        
        $client = new Client;
        // $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
        $storesUrl = env('API_URL', 'https://dev.api.customerpay.me') . '/store';
        $customerUrl = env('API_URL', 'https://dev.api.customerpay.me') . '/customer';

        $storesResponse = $client->request("GET", $storesUrl, ['headers' => ['x-access-token' => Cookie::get('api_token')]]);
        $customersResponse = $client->request("GET", $customerUrl, ['headers' => ['x-access-token' => Cookie::get('api_token')]]);
     
            // $customer = json_decode($customersResponse->getBody())->data;
            // dd($customer);
        $stores = json_decode($storesResponse->getBody())->data->stores;
        // dd($stores);
        // if ($storesResponse->getStatusCode() == 200) {
        //     $stores = json_decode($storesResponse->getBody())->data->stores;
        // } else {
        //     $stores = [];
        // }
        return view('backend.transaction.create');
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
        
        // POST /transaction/new body {
        //     “store_id”: STRING REQUIRED,
        //     “customer_id”: STRING REQUIRED,
        //     “type”: STRING REQUIRED,
        //     “amount”: NUMBER REQUIRED,
        //     “interest”: NUMBER REQUIRED,
        //     “total_amount”: NUMBER REQUIRED,
        //     “status”: CAN BE “paid”, “unpaid”, “pending” by default “unpaid”,
        //     “description”: STRING
        // } (edited) 
        // 9:09
        // GET /transaction body {
        //     “store_id”: STRING REQUIRED,
        //     “customer_id”: STRING REQUIRED
        // }
        // 9:10
        // GET /transaction/:transaction_id body {
        //     “store_id”: STRING REQUIRED,
        //     “customer_id”: STRING REQUIRED
        // }

        // $data = $request->validate([
        //     'amount' => 'required',
        //     'interest' => 'required',
        //     'total_amount' => 'required',
        //     'description' => 'required|string',
        //     'transaction_name' => 'required',
        //      'transaction_role' => 'required',
        //         'type' => 'required',
        //     'store_name' => 'required',
        //     'phone_number' => 'required'
        // ]);
        
            // if ($data) {
                $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/new';
                $client = new Client();
               $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => [
                    'amount' => $request->input('amount'),
                    'interest' => $request->input('interest'),
                    'total_amount' => $request->input('amount') + $request->input('interest'),
                    'description' => $request->input('description'),                    
                    'type' => $request->input('transaction_type'),
                    'store_id' => $request->input('store_name'),
                    'customer_id' => $request->input('customer_name'),
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

                    if ($statusCode == 500){
                        return view('errors.500');
                    }

                   

                    
                }
                
                // $statusCode = $response->getStatusCode();
                // $body = $response->getBody();
                // $data = json_decode($body);()

               
                    
                // if ($response->getStatusCode() == 201) {
                //     $request->session()->flash('alert-class', 'alert-success');
                //     $request->session()->flash('message', 'Transaction successfully created');
                //         return redirect()->route('transaction.index');
                // }
                //     $request->session()->flash('message', 'Transaction failed to create');
                //     $request->session()->flash('alert-class', 'alert-danger');
                //     return redirect()->route('transaction.index');
           

        // } catch (RequestException $e) {


        //     if ($e->getResponse()->getStatusCode() == 400) {
        //         return redirect()->route('transaction.index');
        //     }

        //     // check for 5xx server error
        //     if ($e->getResponse()->getStatusCode() >= 500) {
        //         return view('errors.500');
        //     }
        //     // get response to catch 4xx errors
        //     $response = json_decode($e->getResponse()->getBody());
        //     Session::flash('alert-class', 'alert-danger');
        //     Session::flash('message', $response->error->description);
        //     return redirect()->route('transaction.index', ['response' => []]);

        // } 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/' . $id;

        try {
            $client = new Client;
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ]
            ];
            $response = $client->request("GET", $url, $payload);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $TransData = json_decode($body)->data->transaction;
            if ($statusCode == 200) {

                return view('backend.transaction.show')->with('response', $TransData);
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

        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/' . $id;

        try {
            $client = new Client;
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ]
            ];
            $response = $client->request("GET", $url, $payload);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $TransData = json_decode($body)->data->transaction;
            $Storename = json_decode($body)->data->storeName;
            $transaction_id = $TransData->_id;
            $changes = [
                'id' => $transaction_id,
                'store_name' => $Storename
            ];
            if ($statusCode == 200) {

                return view('backend.transaction.edit')->with(['response' => $TransData, 'store_name' => $Storename]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/update/' . $id;

        try {
            $client = new Client();

            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => [

                    'amount' => $request->input('amount'),
                    'interest' => $request->input('interest'),
                    'total_amount' => $request->input('total_amount'),
                    'description' => $request->input('description'),
                    'transaction_name' => $request->input('transaction_name'),
                    'transaction_role' => $request->input('transaction_role'),
                    'store_name' => $request->input('store_name'),
                    'type' => $request->input('transaction_type'),

                ],

            ];


            $req = $client->request('PUT', $url, $payload);

            $status = $req->getStatusCode();

            if ($status == 200) {

                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Transaction successfully Updated');
                return redirect()->route('transaction.index');
            }
            if ($status == 500) {
                return view('errors.500');
            }
        } catch (\Exception $e) {
            return redirect()->route('transaction.edit', $id);
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
        // return view('backend.transaction.index');
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/delete/' . $id;
        $client = new Client();
        $payload = [
            'headers' => [
                'x-access-token' => Cookie::get('api_token')
            ]
        ];
        try {
            $delete = $client->delete($url, $payload);

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
