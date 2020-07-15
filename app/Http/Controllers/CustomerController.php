<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator as Paginator; // NAMESPACE FOR PAGINATOR
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

// FOR COUNTRY CODE AND PHONE NUMBER IMPLEMENTATION
use App\Rules\DoNotPutCountryCode;
use App\Rules\NoZero;

class CustomerController extends Controller
{

    protected $host;

    public function __construct()
    {
        $this->host = env('API_URL', 'https://dev.api.customerpay.me');
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
            $id = Cookie::get('user_id');
            $url = $this->host.'/customer' ;
            $store_url = $this->host.'/store' ;
            $client = new Client();

            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $user_response = $client->request('GET', $url, $headers);
            $store_response = $client->request('GET', $store_url, $headers);

            $statusCode = $user_response->getStatusCode();
            $statusCode2 = $store_response->getStatusCode();
            $users = json_decode($user_response->getBody());
            $stores = json_decode($store_response->getBody());

            if ( $statusCode == 200 && $statusCode2 == 200 ) {
                $customerArray = [];
                $store_ids = [];
                $store_names = [];
                foreach($users->data->customer as $key => $value) {
                    array_push($customerArray, $users->data->customer[$key]->customers);
                    array_push($store_ids, $users->data->customer[$key]->storeId);
                    array_push($store_names, $users->data->customer[$key]->storeName);
                }

                $allCustomers = [];
                foreach( $customerArray as $key => $value ) {
                    foreach( $value as $k => $val ) {
                        $val->store_id = $store_ids[$key];
                        $val->store_name = $store_names[$key];
                        array_push($allCustomers, $val);
                    }
                }

                // start pagination
                // $perPage = 5;
                // $page = $request->get('page', 1);
                // if ($page > count($allCustomers) or $page < 1) {
                //     $page = 1;
                // }
                // $offset = ($page * $perPage) - $perPage;
                // $articles = array_slice($allCustomers, $offset, $perPage);
                // $datas = new Paginator($articles, count($allCustomers), $perPage);

                $stores = $stores->data->stores;

                return view('backend.customer.index')->with(['response' => $allCustomers, 'stores' => $stores]);
                // return view('backend.customer.index')->with(['response' => $datas->withPath('/'.$request->path()), 'stores' => $stores]);
            }

            if ( $statusCode == 500 ) {
                return view('errors.500');
            }
        } catch(\RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            if ( $statusCode == 401 ) { //401 is error code for invalid token
                return redirect()->route('logout');
            }

            return view('errors.500');
        } catch ( \Exception $e ) {
            if ( $e->hasResponse() ) {
                $statusCode = $e->getResponse()->getStatusCode();
                $data = json_decode($e->getResponse()->getBody()->getContents());
                if ( $statusCode == 401 ) { //401 is error code for invalid token
                    return redirect()->route('logout');
                }
            }        
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

    public function store(Request $request)
    {
        //
        $url = $this->host.'/customer/new/';

        if ($request->isMethod('post')) {
            $request->validate([
                'store_id' => 'required',
                'phone_number' =>  ['required', 'min:6', 'max:16',  new NoZero, new DoNotPutCountryCode],
                'name' => 'required | min:5 | max:30',
            ]);

            try {
                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'store_id' => $request->input('store_id'),
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

                    return back();
                } else {
                    $request->session()->flash('alert-class', 'alert-waring');
                    Session::flash('message', $data->message);
                    return redirect()->view('backend.customer.create');
                }
            } catch (\RequestException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $data = json_decode($e->getResponse()->getBody()->getContents());
                $request->session()->flash('message', isset($data->message) ? $data->message : $data->error->error);
                if ( $statusCode == 401 ) {
                    return redirect()->route('logout');
                }
                return back();
                Log::error((string) $response->getBody());
                return view('errors.500');
            } catch ( \Exception $e ) {
                $statusCode = $e->getResponse()->getStatusCode();
                $data = json_decode($e->getResponse()->getBody()->getContents());
                $request->session()->flash('message', isset($data->message) ? $data->message : $data->error->error);
                if ( $statusCode == 401 ) {
                    return redirect()->route('logout');
                }
                return back();
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

    public function show($id)
    {
        // return view('backend.customer.show');
        if ( !$id || empty($id) ) {
            return view('errors.500');
        }

        $store_id = explode('-', $id)[0];
        $customer_id = explode('-', $id)[1];

        try {
            $url = $this->host."/customer/".$store_id."/".$customer_id;
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $headers);
            $data = json_decode($response->getBody());
            if ( $response->getStatusCode() == 200 ) {
                return view('backend.customer.show')->with('response', $data->data);
            } else {
                return view('errors.500');
            }
        } catch (\RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            $request->session()->flash('message', isset($data->message) ? $data->message : $data->error->error);
            if ( $statusCode == 401 ) {
                return redirect()->route('logout');
            }
            return back();
            Log::error((string) $response->getBody());
            return view('errors.500');
        } catch ( \Exception $e ) {
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            $request->session()->flash('message', isset($data->message) ? $data->message : $data->error->error);
            if ( $statusCode == 401 ) {
                return redirect()->route('logout');
            }
            return back();
            Log::error((string) $response->getBody());
            return view('errors.500');
        }
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
            return redirect()-route('logout');
        }

        $store_id = explode('-', $id)[0];
        $customer_id = explode('-', $id)[1];

        try {
            $url = $this->host."/customer/".$store_id."/".$customer_id;
            $store_url = $this->host.'/store';
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

            $response = $client->request("GET", $url, $headers);
            $store_response = $client->request('GET', $store_url, $headers);

            $data = json_decode($response->getBody());
            $stores = json_decode($store_response->getBody());
            if ( $response->getStatusCode() == 200 && $store_response->getStatusCode() == 200 ) {
                $stores = $stores->data->stores;
                return view('backend.customer.edit')->with(['response' => $data->data, 'stores' => $stores]);
            } else {
                Session::flash('message', "Error occured; can't fetch customer's details at the moment");
                return back();
            }
        } catch (\RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            $request->session()->flash('message', isset($data->message) ? $data->message : $data->error->error);
            if ( $statusCode == 401 ) {
                return redirect()->route('logout');
            }
            return back();
            Log::error((string) $response->getBody());
            return view('errors.500');
        } catch ( \Exception $e ) {
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            Session::flash('message', isset($data->message) ? $data->message : $data->error->error);
            if ( $statusCode == 401 ) {
                return redirect()->route('logout');
            }
            return back();
            Log::error((string) $response->getBody());
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
            'phone_number' =>  ['required', 'min:6', 'max:16',  new NoZero, new DoNotPutCountryCode],
            'name' => 'required | min:5 | max:30',
        ]);

        $store_id = explode('-', $id)[0];
        $customer_id = explode('-', $id)[1];

        try {
            $url = $this->host.'/customer/update/'.$customer_id;

            $client = new Client();

            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => [
                    'phone_number' => $request->input('phone_number'),
                    'name' => $request->input('name'),
                    'store_id' => $store_id,
                ],
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
            $data = json_decode($e->getresponse()->getBody()->getContents());
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
    public function destroy(Request $request, $id)
    {
        //
        try {
            $url = $this->host.'/customer/delete/'.$id;

            $client = new Client();

            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],

            ];

            $response = $client->request("DELETE", $url, $payload);

            $data = json_decode($response->getBody());

            if ( $response->getStatusCode() == 200 ) {
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Customer deleted successfully');

                return redirect()->back();
            } else {
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('message', 'Customer deleting failed');
            }

        } catch ( \Exception $e ) {
            $data = json_decode($e->getBody()->getContents());
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $data->message);

            return redirect()->back();
        }
    }
}
