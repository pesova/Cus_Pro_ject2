<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function sendViaEmail(Request $request, $customer_id) {
    	$data = $request->validate([
            'subject' => 'required',
            'text' => 'required'
            'store_id' =>  'required'
        ]);

		$client = new Client();
		$url = env('API_URL', 'https://api.customerpay.me/') . ' /reminder/email/' . $customer_id;
        $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

        try {
        	$send = $client->post($url, $headers, $data);
        	$statusCode = $status->getStatusCode();

        	if($statusCode == 200 || $statusCode == 201)
        	{
        	    $resp = [
        	    	'message' => 'Email sent successfully'
        	    ];
        	    return $response->json($resp);
        	}
        	else if($statusCode == 401)
        	{
        	    $resp = [
        	    	'message' => 'You are not authorized to use this feature, Login to continue'
        	    ];
        	    return $response->json($resp);
        	}
        	else if($statusCode == 500)
        	{
        	    $resp = [
        	    	'message' => 'A server error encountered, please try again later'
        	    ];
        	    return $response->json($resp);
        	}
        }
        catch($e) {
        	$resp = [
    	    	'message' => 'A technical error occured, please try again later'
    	    ];
    	    return $response->json($resp);
        }
    }
}
