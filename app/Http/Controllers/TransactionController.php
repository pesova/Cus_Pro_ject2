<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class TransactionController extends Controller
{
    public function index()
    {
        $host = env('API_URL', 'https://api.customerpay.me');
        $url = $host."/transaction/all";
        // return $url;
        try {
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request('GET', $url, $headers);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $body = $response->getBody()->getContents();
                $transaction = json_decode($body);
                return view('backend.transactions.index')->with('response', $transaction);
            } else {
                dd($statusCode);
            }
           
        } catch (\Exception $e) {
            // return view('errors.500');
            return view('backend/dashboard')->with('error', "Unable to connect to server");
        }
    }
}
