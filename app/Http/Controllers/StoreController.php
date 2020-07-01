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
    public function create_store(Request $request)
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
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Store created successfully');
            } else {
                $request->session()->flash('message', $body->message);
            }
            return redirect()->route('store.create');
        }
        catch ( \Exception $e ) {
            $response = json_decode($e->getResponse()->getBody()->getContents());
            $request->session()->flash('message', $response->message);
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect()->route('store.create');
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
