<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('backend.transaction.index');
        // $host = env('API_URL', 'https://api.customerpay.me');
        // $url = $host."/transaction/all";
        // // return $url;
        // try {
        //     $client = new Client();
        //     $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
        //     $response = $client->request('GET', $url, $headers);
        //     $statusCode = $response->getStatusCode();
        //     if ($statusCode == 200) {
        //         $body = $response->getBody()->getContents();
        //         $transaction = json_decode($body);
        //         return view('backend.transactions.index')->with('response', $transaction);
        //     } else {
        //         dd($statusCode);
        //     }
           
        // } catch (\Exception $e) {
        //     // return view('errors.500');
        //     return view('backend/dashboard')->with('error', "Unable to connect to server");
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.transaction.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        return view('backend.transaction.report');
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
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/new/';

        if ($request->isMethod('post')) {
            $request->validate([
                'transactionName' => 'required',
                'transactionType' =>  'required',
                'transactionDesc' => 'required',
                'Amount' => 'required',
            ]);

            try {

                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'transactionName' => $request->input('transactionName'),
                        'transactionType' => $request->input('transactionType'),
                        'transactionDesc' => $request->input('transactionDesc'),
                        'Amount' => $request->input('Amount'),
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
                    return redirect()->view('backend.transaction.create');
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

        return view('backend.transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.transaction.show');

        // return view('backend.transaction.show');
        // $host = env('API_URL', 'https://api.customerpay.me/');
        // $url = $host."/transaction/$id";
        // // return $url;
        // try {
        //     $client = new Client();
        //     $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
        //     $response = $client->request('GET', $url, $headers);
        //     $statusCode = $response->getStatusCode();
        //     if ($statusCode == 200) {
        //         $body = $response->getBody()->getContents();
        //         $transactions = json_decode($body);
        //         return view('backend.transactions.show')->with('response', $transactions);
        //     }
        //     if ($statusCode == 500) {
        //         return view('errors.500');
        //     }
        //     if ($statusCode == 401) {
        //         return view('backend.dashboard.index')->with('error', "Unauthoized toke");
        //     }
        //     if ($statusCode == 404) {
        //         return view('backend.dashboard.index')->with('error', "Transaction not found");
        //     }
        // } catch (\Exception $e) {
        //     // return view('errors.500');
        //     return view('backend.dashboard.index')->with('error', "Unable to connect to server");
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.transaction.edit');
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
