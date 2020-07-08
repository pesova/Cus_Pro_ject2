<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
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
        // API updated
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store';

        try {

            $client = new Client;
            $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

            $response = $client->request("GET", $url, $payload);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $Stores = json_decode($body);

            if ($statusCode == 200) {
                return view('backend.stores.index')->with('response', $Stores->data->stores);
            }

        } catch (RequestException $e) {

            Log::info('Catch error: LoginController - ' . $e->getMessage());

            // check for 5xx server error
            if ($e->getResponse()->getStatusCode() >= 500) {
                return view('errors.500');
            }

            // get response to catch 4xx errors
            //$response = json_decode($e->getResponse()->getBody());
            //Session::flash('alert-class', 'alert-danger');
            //Session::flash('message', $response->errors->description);
            return redirect()->route('store.index', ['response' => []]);

        } catch (\Exception $e) {

            //log error;
            Log::error('Catch error: StoreController - ' . $e->getMessage());
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
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store/new';

        if ($request->isMethod('post')) {
            $request->validate([
                'store_name' => 'required|min:2',
                'shop_address' =>  'required',
            ]);

            try {

                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'store_name' => $request->input('store_name'),
                        'shop_address' => $request->input('shop_address'),
                        'email' => $request->input('email'),
                        'tagline' => $request->input('tagline'),
                        'phone_number' => $request->input('phone_number'),
                    ],

                ];

                $response = $client->request("POST", $url, $payload);

                $statusCode = $response->getStatusCode();
                $body = $response->getBody();
                $data = json_decode($body);

                if ($statusCode == 201  && $data->success) {
                    $request->session()->flash('alert-class', 'alert-success');
                    Session::flash('message', $data->message);
                    return $this->index();
                } else {
                    $request->session()->flash('alert-class', 'alert-waring');
                    Session::flash('message', $data->message);
                    return redirect()->route('store.create');
                }
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();

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

        return view('backend.stores.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('backend.stores.index');

        // API updated
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store/' . $id;

        try {
            $client = new Client;
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ],
                'form_params' => [
                    'current_user' => Cookie::get('user_id'),
                ]
            ];
            $response = $client->request("GET", $url, $payload);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $StoreData = json_decode($body)->data->store;
            if ($statusCode == 200) {
            
                return view('backend.stores.show')->with('response', $StoreData);
            }
        } catch (RequestException $e) {

            Log::info('Catch error: LoginController - ' . $e->getMessage());

            // check for 5xx server error
            if ($e->getResponse()->getStatusCode() >= 500) {
                return view('errors.500');
            }
            // get response to catch 4xx errors
            $response = json_decode($e->getResponse()->getBody());
            Session::flash('alert-class', 'alert-danger');
            // dd($response);
            Session::flash('message', $response->message);
            return redirect()->route('store.index', ['response' => []]);

        } catch (\Exception $e) {
            //log error;
            Log::error('Catch error: StoreController - ' . $e->getMessage());
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
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store/' . $id;

        try {
            $client = new Client;
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ],
                'form_params' => [
                    'current_user' => Cookie::get('user_id'),
                ]
            ];
            $response = $client->request("GET", $url, $payload);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $StoreData = json_decode($body)->data->store;
            if ($statusCode == 200) {
            
                return view('backend.stores.edit')->with('response', $StoreData);
            }
        } catch (RequestException $e) {

            Log::info('Catch error: LoginController - ' . $e->getMessage());

            // check for 5xx server error
            if ($e->getResponse()->getStatusCode() >= 500) {
                return view('errors.500');
            }
            // get response to catch 4xx errors
            $response = json_decode($e->getResponse()->getBody());
            Session::flash('alert-class', 'alert-danger');
            // dd($response);
            Session::flash('message', $response->message);
            return redirect()->route('store.index', ['response' => []]);

        } catch (\Exception $e) {
            //log error;
            Log::error('Catch error: StoreController - ' . $e->getMessage());
            return redirect()->route('store.index', ['response' => []]);

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
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store/update/' . $id;

        try {
            $client = new Client();


            $request->validate([
                'store_name' => 'required|min:2',
                'shop_address' =>  'required',
                'phone_number' => 'required|numeric',
                'tag_line' => 'required'
            ]);

            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => [
                    'store_name' => $request->input('store_name'),
                    'shop_address' => $request->input('shop_address'),
                    'email' => $request->input('email'),
                    'tagline' => $request->input('tagline'),
                    'phone_number' => $request->input('phone_number'),
                    'current_user' => Cookie::get('user_id'),
                ],

            ];


            $req = $client->request('PUT', $url, $payload);

            $status = $req->getStatusCode();

            if ($status == 201) {
                return $this->index()->with('message', 'Updated Successfully');
            }
            if ($statusCode == 500) {
                return view('errors.500');
            }

        }catch (\Exception $e) {
            return redirect()->route('store.index', ['response' => []]);
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
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store/delete/' . $id;

        try{
            $client = new Client();

            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

            $req = $client->delete($url,$headers);

            $status = $req->getStatusCode();

            if($status == 200){
                // $data = [
                //     "message" => "Store Deleted",
                //     "class" => "alert-success"
                // ];

                return view('backend.stores.index')->with('data', "Store Deleted");
            }
            if($status == 400){
                return view('backend.stores.index')->with('message', 'Invalid ID supplied');
            }
            if($status == 404){
                return view('errors.404');
            }

           
        }catch (\Exception $e) {
            return view('errors.500');
        }
    }
}
