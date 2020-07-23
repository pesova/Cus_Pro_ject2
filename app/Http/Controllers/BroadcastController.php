<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

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
        return view('backend.broadcasts.index');
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
        dd($request->all());
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
