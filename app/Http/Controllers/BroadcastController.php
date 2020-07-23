<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Rules\DoNotPutCountryCode;
use App\Rules\NoZero;

class BroadcastController extends Controller
{
    protected $host;
    protected $headers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->host = env('API_URL', 'https://dev.api.customerpay.me');
        $this->headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $user_url = env('API_URL', 'https://dev.api.customerpay.me'). '/customer' ;
            $store_url = env('API_URL', 'https://dev.api.customerpay.me'). '/store' ;
            $client = new Client();

            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $user_response = $client->request('GET', $user_url, $headers);
            $store_response = $client->request('GET', $store_url, $headers);

            $statusCode = $user_response->getStatusCode();
            $statusCode2 = $store_response->getStatusCode();
            $users = json_decode($user_response->getBody());
            $stores = json_decode($store_response->getBody());

            if ( $statusCode == 200 && $statusCode2 == 200 ) {
                $customerArray = [];
                $store_ids = [];
                $store_names = [];

                foreach($users->data->customer as $key => $value) {
                    array_push($customerArray, $users->data->customer[$key]->customers);
                    array_push($store_ids, $users->data->customer[$key]->storeId);
                    array_push($store_names, $users->data->customer[$key]->storeName);
                }

                $allCustomers = [];
                foreach( $customerArray as $key => $value ) {
                    foreach( $value as $k => $val ) {
                        $val->store_id = $store_ids[$key];
                        $val->store_name = $store_names[$key];
                        array_push($allCustomers, $val);
                    }
                }

                $stores = $stores->data->stores;

                return view('backend.broadcasts.index')->with(['data' => $allCustomers, 'stores' => $stores]);
            }

            if ( $statusCode == 500 ) {
                return view('errors.500');
            }

        } catch(RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            if ( $statusCode == 401 ) { //401 is error code for invalid token
                return redirect()->route('logout');
            }

            return view('errors.500');
        } catch ( \Exception $e ) {
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            if ( $statusCode == 401 ) { //401 is error code for invalid token
                return redirect()->route('logout');
            }

            return view('errors.500');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->get($this->host . '/message/numbers', ['headers' => ['x-access-token' => Cookie::get('api_token')]]);

            if ($response->getStatusCode() == 200) {
                $res = json_decode($response->getBody());
                $customers = get_object_vars($res->data);
                return view('backend.broadcasts.create')->with(['customers' => $customers]);
            }
        } catch (RequestException $e) {
            Log::error('Catch error: Create Broadcast'. $e->getMessage());
            $request->session()->flash('message', 'Failed to fetch customer, please try again');
            return view('backend.broadcasts.create');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->post($this->host . '/message/send', [
                'json' => [
                    'message' => $request->input('message'),
                    'numbers' => $request->input('numbers')
                ],
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                    ]
                ]);

            if ($response->getStatusCode() == 200) {
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Broadcast message sent !');
                return back();
            }
        } catch (RequestException $e) {
            Log::error('Catch error: Create Broadcast' . $e->getMessage());
            $request->session()->flash('message', 'Ooops, failed to send broadcast, please try again');
            return back();
        }

        // $url = env("SMS_API_URL","https://api.sandbox.africastalking.com/version1/messaging");

        // try{
        //     $client = new Client;
        //     $payload = [
        //         'headers' => [
        //             'apiKey' => env('AT_KEY', "3f18b458d8d12b7fbdd7f85665e878f05d99c1f8c773dccc5ef21d3ea80cfb21"),
        //             "Content-type" => "application/x-www-form-urlencoded",
        //             "Accept" => "application/json"
        //         ],
        //         'form_params' => [
        //            "username" => env('AT_USERNAME',"sandbox"),
        //            "to" => $request->input('receiver'),
        //            "message" => $request->input('message'),
        //            "bulkSMSMode" => "1",
        //            "enqueue" => "1",
        //         ]
        //     ];

        //     $response = $client->request("POST", $url, $payload);
        //     $data = json_decode($response->getBody());
        //     $status = $data->SMSMessageData->Recipients;

        //     foreach($status as $recepient) {
        //         if ($recepient->status == "Success") {
        //             return redirect()->route('broadcast.index')->with('response', $recepient->status);
        //         }
        //         return redirect()->route('broadcast.create')->with('response', "Failed");
        //     }

        // }catch(\RequestException $e){
        //     $statusCode = $e->getResponse()->getStatusCode();
        //     $data = json_decode($e->getResponse()->getBody()->getContents());
        //     if ( $statusCode == 401 ) { //401 is error code for invalid token
        //         return redirect()->route('broadcast.create')->with('response', $data->message);
        //     }
        // }catch(\Exception $e){
        //     return view("errors.500");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
