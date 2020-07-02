<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //API updated
        $url = env('API_URL', 'https://api.customerpay.me') . '/store/all/' . Cookie::get('user_id');

        try {
            $client = new Client;
            $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $payload);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $Stores = json_decode($body);
            if ($statusCode == 200) {
                return view('backend.stores.store_list')->with('response', $Stores->data->stores);
            }
        } catch (\Exception $e) {
            $response = $e->getResponse();

            if ($response->getStatusCode() == 401) {
                $data = json_decode($response->getBody());
                Session::flash('message', $data->message);
                return redirect()->route('stores', ['response' => []]);
            }

            if ($response->getStatusCode() == 500) {
                Log::error((string) $response->getBody());
                return view('errors.500');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $url = env('API_URL', 'https://api.customerpay.me') . '/store/all/' . Cookie::get('user_id');

        if ($request->isMethod('post')) {
            $request->validate([
                'store_name' => 'required|min:2',
                'store_address' =>  'required',
            ]);

            try {

                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'store_name' => $request->input('store_name'),
                        'store_address' => $request->input('store_address'),
                        'email' => $request->input('email'),
                        'tagline' => $request->input('tagline'),
                        'phone_number' => $request->input('phone_number'),
                    ],

                ];

                $response = $client->request("POST", $url, $payload);

                $statusCode = $response->getStatusCode();
                $body = $response->getBody();
                $Stores = json_decode($body);
                if ($statusCode == 200) {
                    return view('backend.stores.store_list')->with('response', $Stores->data->stores);
                }
            } catch (\Exception $e) {
                $response = $e->getResponse();

                if ($response->getStatusCode() == 401) {
                    $data = json_decode($response->getBody());
                    Session::flash('message', $data->message);
                    return redirect()->route('stores', ['response' => []]);
                }

                if ($response->getStatusCode() == 500) {
                    Log::error((string) $response->getBody());
                    return view('errors.500');
                }
            }
        }

        return view('backend.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.stores.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.stores.edit');
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
