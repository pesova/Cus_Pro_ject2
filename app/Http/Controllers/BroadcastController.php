<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class BroadcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.broadcasts.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.broadcasts.send');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = env('SMS_API_URL', 'https://sms.microapi.dev') . "/v1/sms/infobip/send_sms";
        // $url = env('API_URL', 'https://dev.api.customerpay.me/register/user');


        try{
            $client = new Client;
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ],
                'form_params' => [
                   'senderID' => Cookie::get('user_id'),
                   //'senderID' => 1,
                    'receiver' => $request->input('receiver'),
                    'content' => $request->input('message')
                ]
            ];

            $response = $client->request("POST", $url, $payload);
            $data = json_decode($response->getBody());
            $status = $response->getStatusCode();

            if ($status == 200){
               //return dd($data);

               return redirect()->route('broadcast.create')->with('response', "Message sent");
            }else{
                return view("errors.500");
            }

        }catch(\RequestException $e){
            $statusCode = $e->getResponse()->getStatusCode();
            $data = json_decode($e->getResponse()->getBody()->getContents());
            if ( $statusCode == 401 ) { //401 is error code for invalid token
                return redirect()->route('broadcast.create')->with('response', $data->message);
            }
        }catch(\Exception $e){
            return view("errors.500");
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
