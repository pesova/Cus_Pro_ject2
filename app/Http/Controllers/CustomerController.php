<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
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
        return view('backend.customer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.customer.edit');
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
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/customer/update/$id';

        if ($request->isMethod('post')) {
            $request->validate([
                'full_name' => 'required',
                'email' =>  'required',
                'phone_number' => 'required',
                'customer_type' => 'required',
                'status' => 'required',
                'address' => 'required',
                'comment' => 'required',
                'file' => 'required'
            ]);

            try {

                $client =  new Client();
                $data = [
                    'full_name' => $request->input('full_name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'customer_type' => $request->input('customer_type'),
                    'status' => $request->input('status'),
                    'address' => $request->input('address'),
                    'comment' => $request->input('comment'),
                    'file' => $request->input('file'),
                ]
                $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

                $req = $client->request('PUT', $url, $headers, $data);

                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $body = $req->getBody()->getContents();
                    $response = json_decode($body);
                    return redirect()->route('customer.edit');
                }
                if ($statusCode == 500) {
                    return view('errors.500');
                }
                if ($statusCode == 401) {
                    return view('customer.update')->with('error', "Unauthoized token");
                }
                if ($statusCode == 404) {
                    return view('errors.404');    
                }
            } catch (\Exception $e) {
                return view('errors.500');
            }
        }
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
