<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ActivateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Cookie::get('is_active')) {
            return redirect()->route('dashboard');
        }

        try {
            $url = env('API_URL', 'https://api.customerpay.me') . '/otp/send';
            $client = new Client();
            $response = $client->post($url, [
                'form_params' => [
                    'phone_number' => Cookie::get('phone_number'),
                ]
            ]);
            
            if ($response->success) {
                // set alert
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Kindly check your Phone for verification code');
            } else {
                $message = $response->message;
                $request->session()->flash('message', $message);
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody());
                Session::flash('message', $response->message);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return view('backend.user.activate')->with([
            'apiToken' => Cookie::get('api_token'),
            'phoneNumber' => Cookie::get('phone_number')
        ]);
    }

    public function activate(Request $request)
    {
        try {
            $url = env('API_URL', 'https://api.customerpay.me') . '/otp/verify';
            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => [
                    'phone_number' => $request->input('phone_number'),
                    'verify' => $request->input('code')
                ],
            ];

            $client = new Client();
            $response = $client->post($url, $payload);

            if ($response->success) {
                return response()->json(['response' => 'success']);
            } else {
                return response()->json(['response' => 'failed']);
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody());
                Session::flash('message', $response->message);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        // Cookie::queue('is_active', true);
        // if ($request->has('skip')) {
        //     return redirect()->route('dashboard');
        // }
        // return 'done';
    }
}
