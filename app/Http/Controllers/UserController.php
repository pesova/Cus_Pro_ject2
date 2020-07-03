<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('dashboard');

        // if (Cookie::get('is_active') == true) {
        //     return redirect()->route('dashboard');
        // }

        // $api_token = Cookie::get('api_token');
        // $phone_number = Cookie::get('phone_number');
        // return view("backend.user.activate")->withApiToken($api_token)->withPhoneNumber($phone_number);
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
        // return view('backend.dashboard.index');
        $host = env('API_URL', 'https://dev.api.customerpay.me/');
        $url = $host."/user/delete/$id";
        // return $url;
        try {
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request('GET', $url, $headers);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $body = $response->getBody()->getContents();
                $transactions = json_decode($body);
                return view('backend.dashboard.index')->with('response', $transactions);
            }
            if ($statusCode == 500) {
                return view('errors.500');
            }
            if ($statusCode == 401) {
                return view('backend.dashboard.index')->with('error', "Unauthoized toke");
            }
            if ($statusCode == 404) {
                return view('backend.dashboard.index')->with('error', "User not found");
            }
        } catch (\Exception $e) {
            // return view('errors.500');
            return view('backend.dashboard.index')->with('error', "Unable to connect to server");
        }
    }
}
