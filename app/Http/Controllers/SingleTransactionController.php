<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class SingleTransactionController extends Controller
{
    //
    public function index($id)
    {
        $host = env('API_URL', 'https://api.customerpay.me/');
        $url = $host."/transaction/$id";
        // return $url;
        try {
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request('GET', $url, $headers);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $body = $response->getBody()->getContents();
                $transaction = json_decode($body);
                return view('backend.transactions.show')->with('response', $transaction);
            }
            if ($statusCode == 500) {
                return view('errors.500');
            }
            if ($statusCode == 401) {
                return view('backend.transactions.index')->with('error', "Unauthoized toke");
            }
            if ($statusCode == 404) {
                return view('backend.transactions.index')->with('error', "Transaction not found");
            }
        } catch (\Exception $e) {
            // return view('errors.500');
            return view('backend.transactions.index')->with('error', "Unable to connect to server");
        }
    }
}
