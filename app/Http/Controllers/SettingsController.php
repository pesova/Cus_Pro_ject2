<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    // Defining headers
    public $headers;
    public $user_id;

    // Controller action to display settings page.
    public function index() {

        // Setting header
        $this->headers = [ 'headers' => ['x-access-token' => Cookie::get('api_token')] ];

        // Setting User_id
        $this->user_id = Cookie::get('user_id');

        try{
            $url = env('API_URL', 'https://dev.api.customerpay.me'). '/user' .'/' . $this->user_id ;
            $client = new Client();
            $user_detail_process = $client->request('GET', $url, $this->headers);

            if ( $user_detail_process->getStatusCode() == 200 ) {

                $res = json_decode($user_detail_process->getBody(), true);
                return view('backend.settings.settings')->with('user_details', $res);
            }
            if ($user_detail_process->getStatusCode() == 500) {

                return view('errors.500');
            }
        } catch(\Exception $e) {
            Log::error('Catch error: SettingsController -', $e->getMessage());
            return view('errors.500');
        }
    }

    // Controller action to update user details.
    public function update(Request $request) {

        // Setting header
        $this->headers = [ 'headers' => ['x-access-token' => Cookie::get('api_token')] ];

        // Setting User_id
        $this->user_id = Cookie::get('user_id');

        try{

            // check if all fields are available
            if($request->all()) {

                $control = $request->input('control', '');

                if ($control == 'profile_update') {

                    $url = env('API_URL', 'https://api.customerpay.me'). '/user/update/' . $this->user_id ;
                    $client = new Client();
                    $data = [
                        // "content" => [
                            "first_name" => $request->input('first_name'),
                            "last_name" => $request->input('last_name'),
                            "email" => $request->input('email')
                        // ]
                    ];
                    // make an api call to update the user_details
                    $form_response_process = $client->request('PUT', $url, $this->headers, $data);

                } elseif ($control == 'password_change') {

                    // $url = env('API_URL', 'https://api.customerpay.me'). '/reset-password';
                    $url = env('API_URL', 'https://api.customerpay.me'). '/user/update/' . $this->user_id ;
                    $client = new Client();
                    $data = [
                        // "content" => [
                            // 'current_password' => $request->input('current_password'),
                            "new_password" => $request->input('new_password')
                        // ]
                    ];
                    // make an api call to update the user_details
                    $form_response_process = $client->request('PUT', $url, $this->headers, $data);

                } else {

                    return view('errors.404');
                }

                $url = env('API_URL', 'https://api.customerpay.me'). '/user/' . $this->user_id ;
                $client = new Client();
                $user_detail_res_pocess = $client->request('GET', $url, $this->headers);

                if ( $user_detail_res_pocess->getStatusCode() == 200 ) {

                    $user_detail_res = json_decode($user_detail_res_pocess->getBody(), true);
                    $form_response = json_decode($form_response_process->getBody(), true);
                    return view('backend.settings.settings')->with([
                        'user_details' => $user_detail_res,
                        'form_response' => $form_response
                    ]);
                }
                if ($user_detail_res_pocess->getStatusCode() == 500) {
                    return view('errors.500');
                }
                if ($user_detail_res_pocess->getStatusCode() == 400) {

                    $user_detail_res = json_decode($user_detail_res_pocess->getBody(), true);
                    $form_response = json_decode($form_response->getBody(), true);
                    return view('backend.settings.settings')->with([
                        'user_details' => $user_detail_res,
                        'form_response' => $form_response
                    ]);
                }
            } else {
                return redirect()->route('settings');
            }
        } catch(\Exception $e) {
            Log::error('Catch error: SettingsController -', $e->getMessage());
            return view('errors.500');
        }
    }
}
