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
                'name' => 'required',
                'email' =>  'required',
                'phone' => 'required'
            ]);

            try {

                $client =  new Client();
                $data = [
                    'form_params' => [
                        'name' => $request->input('full_name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone_number')
                    ]
                ];
                
                $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

                $req = $client->request('PUT', $url, $headers, $data);

                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $request->session()->flash('alert-class', 'alert-success');
                    $request->session()->flash('message', 'Customer Details Updated Successfully');
                } else {
                    $request->session()->flash('alert-class', 'alert-danger');
                    $request->session()->flash('message', 'Customer Details Update Failed');
                }
                return redirect()->back();
            } catch (\Exception $e) {
                $data = json_decode($e->getBody()->getContents());
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('msg', $data->message);
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
