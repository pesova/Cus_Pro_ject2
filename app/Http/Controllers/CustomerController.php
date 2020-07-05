<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator as Paginator; // NAMESPACE FOR PAGINATOR
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    protected $host;

    public function __construct()
    {
        $this->host = env('API_URL', 'https://dev.api.customerpay.me/');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $response = [];
        return view('backend.customer.index')->with($response);
        //
        // try {
        //     $url = env('API_URL', 'https://dev.api.customerpay.me/'). 'customer/all' ;
        //     $client = new Client();
        //     $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
        //     $user_response = $client->request('GET', $url, $headers);

        //     if ( $user_response->getStatusCode() == 200 ) {
        //         $users = json_decode($user_response->getBody());

        //         // start pagination
        //         $perPage = 10;
        //         $page = $request->get('page', 1);
        //         if ($page > count($users->data) or $page < 1) {
        //             $page = 1;
        //         }
        //         $offset = ($page * $perPage) - $perPage;
        //         $articles = array_slice($users->data, $offset, $perPage);
        //         $datas = new Paginator($articles, count($users->data), $perPage);

        //         return view('backend.customer.index')->with('response', $datas->withPath('/'.$request->path()));
        //     }
        //     if ($user_response->getStatusCode() == 500) {
        //         return view('errors.500');
        //     }
        // } catch(\Exception $e) {
        //     return view('errors.500');
        // }
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
        try {
            $client = new Client;
            $inputs = [
                'phone_number' => $request->phone,
                'name' => $request->name
            ];
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ],
                'form_params' => [
                    'phone' => $request->phone,
                    'name' => $request->name
                ]
            ];

            $url = $this->host.'customer/new';
            $response = $client->request("POST", $url, $payload);
            $data = json_decode($response->getBody());

            if ( $response->getStatusCode() == 200 ) {
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Customer created successfully');
            } else {
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('message', $data->message || 'An error occured');
            }

            return redirect()->route('customers');
        } catch ( \Exception $e ) {
            $data = json_decode($e->getBody()->getContents());
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $data->message);

            return redirect()->route('customers');
        }
    }
        
    public function store(Request $request)
    {
        //
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/customer/new/';

        if ($request->isMethod('post')) {
            $request->validate([
                'store_name' => 'required',
                'phone_number' =>  'required',
                'name' => 'required',
            ]);

            try {

                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'store_name' => $request->input('store_name'),
                        'phone_number' => $request->input('phone_number'),
                        'name' => $request->input('name'),
                    ],

                ];

                $response = $client->request("POST", $url, $payload);

                $statusCode = $response->getStatusCode();
                $body = $response->getBody();
                $data = json_decode($body);

                if ($statusCode == 201  && $data->success) {
                    $request->session()->flash('alert-class', 'alert-success');
                    Session::flash('message', $data->message);
                    // return $this->index();
                } else {
                    $request->session()->flash('alert-class', 'alert-waring');
                    Session::flash('message', $data->message);
                    return redirect()->view('backend.customer.create');
                }
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $statusCode == $response->getStatusCode();

                if ($statusCode  == 500) {
                    Log::error((string) $response->getBody());
                    return view('errors.500');
                }

                $data = json_decode($response->getBody());
                Session::flash('message', $data->message);
                return redirect()->route('store.create');
            } catch (Exception $e) {
                Log::error((string) $response->getBody());
                return view('errors.500');
            }
        }

        return view('backend.customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewCustomer($id)
    {
        //
        if ( !$id || empty($id) ) {
            return view('errors.500');
        }

        try {
            $url = $this->host.'customer/'.$id;
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $headers);
            $data = json_decode($response->getBody());

            if ( $response->getStatusCode() == 200 ) {
                return view('backend.customer.show')->with('response', $data->data);
            } else {
                return view('errors.500');
            }
        } catch ( \Exception $e ) {
            return view('errors.500');
        }
    }
    
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
        //
        if ( !$id || empty($id) ) {
            return view('errors.500');
        }

        try {
            $url = $this->host.'customer/'.$id;
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $headers);
            $data = json_decode($response->getBody());
            
            if ( $response->getStatusCode() == 200 ) {
                return view('backend.customer.edit')->with('response', $data->data);
            } else {
                return view('errors.500');
            }
        } catch ( \Exception $e ) {
            return view('errors.500');
        }
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
        $request->validate([
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required'
        ]);

        try {
            $url = $this->host.'customer/update/'.$id;
            $client = new Client;
            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email
                ]
            ];
            $response = $client->request("PUT", $url, $payload);
            $data = json_decode($response->getBody());
            
            if ( $response->getStatusCode() == 200 ) {
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Customer updated successfully');
            
                return redirect()->back();
            } else {
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('message', 'Customer update failed');
            }

        } catch ( \Exception $e ) {
            $data = json_decode($e->getBody()->getContents());
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $data->message);

            return redirect()->back();
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
