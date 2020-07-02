<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator as Paginator; // NAMESPACE FOR PAGINATOR
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{

    protected $host;

    public function __construct()
    {
        $this->host = env('API_URL', 'https://customerpay.me/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        //
        try {
            $url = env('API_URL', 'https://api.customerpay.me/'). '/customer/all' ;
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $user_response = $client->request('GET', $url, $headers);

            if ( $user_response->getStatusCode() == 200 ) {
                $users = json_decode($user_response->getBody(), true);

                $perPage = 10;
                $page = $request->get('page', 1);
                if ($page > count($users) or $page < 1) {
                    $page = 1;
                }
                $offset = ($page * $perPage) - $perPage;
                $articles = array_slice($users, $offset, $perPage);
                $datas = new Paginator($articles, count($users), $perPage);

                return view('backend.customers.index')->with('response', $datas->withPath('/'.$request->path()));
            }
            if ($user_response->getStatusCode() == 500) {
                return view('errors.500');
            }
        } catch(\Exception $e) {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_customer(Request $request)
    {
        //
        if ( $request->password !== $request->repassword ) {
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', 'Passwords do not match');

            return redirect()->route('customers');
        }
        try {
            $client = new Client();
            $inputs = [
                'phone_number' => $request->phone,
                'name' => $request->name
            ];
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ],
                'form_params' => [
                    'phone_number' => $request->phone,
                    'name' => $request->name
                ]
            ];

            $url = $this->host.'customer/new';
            $response = $client->post($url, $payload);
            $data = json_decode($response->getBody());

            if ( $response->getStatusCode() == 200 ) {
                $request->session()->flash('alert-class', 'alert-success');
            } else {
                $request->session()->flash('alert-class', 'alert-danger');
            }

            $request->session()->flash('message', $data->message);
            return redirect()->route('customers');
        } catch ( \Exception $e ) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $data->message);

            return redirect()->route('customers');
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
