<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function index()
    {
    	try {
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request('GET', "https://dev.customerpay.me/complaints/all", $headers);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $body = $response->getBody()->getContents();
                $complaints = json_decode($body);
                return view('backend.complaintlog.complaintlog')->with('response', $complaints);
            }
            if ($statusCode == 500) {
                return view('errors.500');
            }
            if ($statusCode == 401) {
                return view('backend.complaintlog.complaintlog')->with('error', "Unauthoized token");
            }
            if ($statusCode == 404) {
                return view('backend.complaintlog.complaintlog')->with('error', "Complaint not found");
            }
        } catch (\Exception $e) {
            // return view('errors.500');
            return view('backend.complaintlog.complaintlog')->with('error', "Unable to connect to server");
        }
    }
}