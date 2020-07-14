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

            if ($response->getStatusCode() == 200) {
                $response = json_decode($response->getBody());
                $data = $response->data;
            }
            if ($response->success) {
                // set alert
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'kindly check your Phone for verification code');
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
        Cookie::queue('is_active', true);
        if ($request->has('skip')) {
            return redirect()->route('dashboard');
        }
        return 'done'; // this method will be called via ajax. returning "done" is just a placeholder text for the callback function of the calling script
    }
}
