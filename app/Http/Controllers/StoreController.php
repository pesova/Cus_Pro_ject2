<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = [
            'email' => $request->email,
            'store_name' => $request->store_name, 
            'Phone_number' => $request->phone, 
            'shop_address' => $request->address,
            'tagline' => $request->tag_line
        ];
        $url = env('API_URL', 'https://api.customerpay.me'). '/store/new';
        
        try {
            $client = new Client;
            $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')], 'form_params' => $inputs];
            $response = $client->request("POST", $url, $payload);
            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody()->getContents());

            if ( $statusCode == 201 ) {
                return view('backend.stores.create')->with('success', 'Store created successfully');
            } else {
                return view('backend.stores.create')->with('error', $body->message);
            }
        }
        catch ( \Exception $e ) {
            if ( method_exists($e, 'getResponse') ) {
                $response = json_decode($e->getResponse()->getBody()->getContents());
                return view('backend.stores.create')->with('error', $response->message);
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
