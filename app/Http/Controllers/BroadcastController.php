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

            $templates = [
                "Happy new year!",
                "We are now open!",
                "New stocks just arrived!",
                "Happy new Month",
                "Shop with ...., we Deliver!",
                "Thank you for shopping with ...",
                "We now sell Bobo!"
            ];           
            return view('backend.broadcasts.index')->with(['template' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->get($this->host . '/message/numbers', ['headers' => ['x-access-token' => Cookie::get('api_token')]]);
            $template = $request->input("temp");

           
            
            if ($response->getStatusCode() == 200) {

               // dd($template);
                $res = json_decode($response->getBody());
                $customers = get_object_vars($res->data);
                return view('backend.broadcasts.create')->with(['customers' => $customers, "template" => $template]);
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
            if($e->getStatusCode() == 401){
               
                return redirect()->route("logout");
            }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function template(Request $request)
    {
      
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
