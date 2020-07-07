<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $host = env('API_URL', 'https://dev.api.customerpay.me/');
      $user_id = Cookie::get('user_id');
      $url = $host."complaints/$user_id";
       try {
          $client = new Client();
          $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
          $response = $client->request('GET', $url, $headers);
          $statusCode = $response->getStatusCode();
          if ($statusCode == 200) {
              $body = $response->getBody()->getContents();
              $complaints = json_decode($body);
              return view('backend.complaints.index')->with('responses', $complaints);
          }
          if ($statusCode == 500) {
              return view('errors.500');
          }
      } catch (\Exception $e) {
          return view('errors.500');
          
      }
        // return view('backend.complaints.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.complaints.create');
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
        $url = env('API_URL', 'https://dev.api.customerpay.me/'). "/complaint/update/$complaint_id";

        try {
            $client = new Client();

            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $request->validate([
    			'message' => 'required'
			]);

            $data = [ "message" => $request->input('message') ];
            $req = $client->request('PUT', $url, $headers, $data);

            $statusCode = $req->getStatusCode();

			if ($statusCode == 200) {
                $body = $req->getBody()->getContents();
                $response = json_decode($body);
                return redirect()->route('complaint.log');
            }
            if ($statusCode == 500) {
                return view('errors.500');
            }
            if ($statusCode == 401) {
            	//Uncomment this when frontend has created the form page
                //return view('backend.complaintlog.update')->with('error', "Unauthoized token");
                return response()->json([
                    "message" => "401, Unauthorized token",
			        "info" => "Please, If the frontend for the update form has been done, uncomment line 114 of ComplaintsLogController to render the page"
                ]);
            }
            if ($statusCode == 404) {
            	//Uncomment this when frontend has created the form page
                //return view('backend.complaintlog.update')->with('error', "Complaint not found");
                return response()->json([
                    "message" => "401, Unauthorized token",
			        "info" => "Please, If the frontend for the update form has been done, uncomment line 122 of ComplaintsLogController to render the page"
                ]);
            }
        } catch (\Exception $e) {
            return view('errors.500');
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
        $host = env('API_URL', 'https://dev.api.customerpay.me/');
        $url = $host."complaint/delete/5efc5cb9aea77164da871ee9";
        $request = new HttpRequest();
        $request->setUrl($url);
        $request->setMethod(HTTP_METH_DELETE);
        
        $request->setHeaders(array(
          'postman-token' => 'b6c9656d-4feb-d9f0-2b1d-0d26753ebbcd',
          'cache-control' => 'no-cache',
          'complaint_id' => $id
        ));
        
        try {
          $response = $request->send();
        
          echo $response->getBody();
        } catch (HttpException $ex) {
          echo $ex;
        }
    }
}
