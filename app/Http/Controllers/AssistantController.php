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

class AssistantController extends Controller
{
    protected $host;

    public function __construct()
    {
        $this->host = env('API_URL', 'https://dev.api.customerpay.me/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // API updated
         $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant';

         try {

             $client = new Client;
             $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

             $response = $client->request("GET", $url, $payload);
             $statusCode = $response->getStatusCode();
             $body = $response->getBody();
             $Stores = json_decode($body);

             if ($statusCode == 200) {
                 return view('backend.assistant.index')->with('response', $Stores->data->assistants);
             }
             else if($statusCode->getStatusCode() == 401){
                 Session::flash('message', "You are not authorized to perform this action");
                return redirect()->route('assistants.index');
            }

         } catch (RequestException $e) {

             Log::info('Catch error: LoginController - ' . $e->getMessage());

             // check for 5xx server error
             if ($e->getResponse()->getStatusCode() >= 500) {
                 return view('errors.500');
             }


            // return redirect()->route('assistants.index', ['response' => []]);

         } catch (\Exception $e) {

             //log error;
             Log::error('Catch error: StoreController - ' . $e->getMessage());
             return view('errors.500');
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if($request){
        //      $id = $request->get("assistant");
        //     return view('backend/assistant/create')->with("assistant" , $id);

        //     //return $request->get("assistant");
        // }else{
            return view('backend/assistant/create');
        //}
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create_assistant(Request $request)
    {
        //
        try {
            $client = new Client;
            $inputs = [
                'phone_number' => $request->phone,
                'name' => $request->name

            ];
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ],
                'form_params' => [
                    'phone' => $request->phone,
                    'name' => $request->name
                ]
            ];

            $url = $this->host.'assistant/new';
            $response = $client->request("POST", $url, $payload);
            $data = json_decode($response->getBody());

            if ( $response->getStatusCode() == 200 ) {
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Assistant created successfully');
            } else {
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('message', $data->message || 'An error occured');
            }

            return redirect()->route('assistants');
        } catch ( \Exception $e ) {
            $data = json_decode($e->getBody()->getContents());
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $data->message);

            return redirect()->route('assistants');
        }
    }

    public function store(Request $request)
    {
        //return dd($request->all());

        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant/new';

        if ($request->isMethod('post')) {
            //return dd($request->all());
            
            $request->validate([
                'name' => "required|min:6",
                'phone_number' => "required",
                //'store_name' => "required",
                'email' => "required|email",
                'password' => "required"
            ]);

            try {

                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'name' => $request->input('name'),
                        'phone_number' => $request->input('phone_number'),
                        'email' => $request->input('email'),
                        'password' => $request->input('password')
                    ],
                ];
                //return dd($payload);
                $response = $client->request("POST", $url, $payload);
                $statusCode = $response->getStatusCode();
                
                //return $statusCode;
                $body = $response->getBody();
                $data = json_decode($body);
                //return dd($data);

                if ($statusCode == 201  && $data->success) {
                    $request->session()->flash('alert-class', 'alert-success');
                    Session::flash('message', $data->message);
                    //return redirect()->route('assistants.create');
                } else {
                    $request->session()->flash('alert-class', 'alert-waring');
                    Session::flash('message', $data->message);
                    return redirect()->route('assistants.create');
                }
            } catch (ClientException $e) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();

                if ($statusCode  == 500) {
                    Log::error((string) $response->getBody());
                    return view('errors.500');
                }

                $data = json_decode($response->getBody());
                Session::flash('message', $data->message);
                return redirect()->route('assistants.create');
                //return back();
            } catch (Exception $e) {
                dd( $e->getMessage());
                Log::error($e->getMessage());
                return view('errors.500');
            }
        }
        return view('backend.assistant.index');
        //return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewAssistant($id)
    {
        //
        if ( !$id || empty($id) ) {
            return view('errors.500');
        }

        try {
            $url = $this->host.'assistant/'.$id;
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $headers);
            $data = json_decode($response->getBody());

            if ( $response->getStatusCode() == 200 ) {
                return view('backend.assistant.show')->with('response', $data->data);
            } else {
                return view('errors.500');
            }
        } catch ( \Exception $e ) {
            return view('errors.500');
        }
    }

    public function show($id)
    {
        return view('backend.assistant.show');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ( !$id || empty($id) ) {
            return view('errors.500');
        }

        try {
           // $url = $this->host.'assistant/'.$id;
           $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant/' . $id;
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $headers);
            $data = json_decode($response->getBody());
            
            if ( $response->getStatusCode() == 200 ) {
                return view('backend.assistant.update')->with('response', $data->data->assistants);
                
            } else {
                return view('errors.500');
            }
        } catch ( \Exception $e ) {
            return view('errors.500');
            //return $response->getStatusCode();
        }
    }
    // public function edit($id)
    // {
    //     $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant/' . $id;

    //     try {
    //         $client = new Client;
    //         $payload = [
    //             'headers' => [
    //                 'x-access-token' => Cookie::get('api_token')
    //             ],
    //             'form_params' => [
    //                 'current_user' => Cookie::get('user_id'),
    //             ]
    //         ];
    //         $response = $client->request("GET", $url, $payload);
    //         $statusCode = $response->getStatusCode();
    //         $body = $response->getBody();
    //         $StoreData = json_decode($body)->data->store;
    //         if ($statusCode == 200) {
            
    //             return view('backend.assistant.edit')->with('response', $StoreData);
    //         }
    //     } catch (RequestException $e) {

    //         Log::info('Catch error: LoginController - ' . $e->getMessage());

    //         // check for 5xx server error
    //         if ($e->getResponse()->getStatusCode() >= 500) {
    //             return view('errors.500');
    //         }
    //         // get response to catch 4xx errors
    //         $response = json_decode($e->getResponse()->getBody());
    //         Session::flash('alert-class', 'alert-danger');
            
    //         Session::flash('message', $response->message);
    //         return redirect()->route('assistants.index', ['response' => []]);

    //     } catch (\Exception $e) {
    //         //log error;
    //         Log::error('Catch error: StoreController - ' . $e->getMessage());
    //         return redirect()->route('assistants.index', ['response' => []]);

    //     }
    // }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $url = env('API_URL', 'https://api.customerpay.me/') . '/assistant/update/' . $id;


        try{
            $request->validate([
                'name' => "required|min:6",
                'phone_number' => "required",
                'email' => "required|email",
                'password' => "required"
            ]);

            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $data = [
                $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'password' => $request->input('password')
                ],
            ];

            $response = $client->request("PUT", $url, $data);
            $status = $response->getStatusCode();

            if($status == 200){
                $body = $response->getBody()->getContents();
                $res = json_encode($body);
                return redirect()->view('backend.assistant.index')->with('message', "Update Successful");
            }else {
                return redirect()->view('backend.assistant.index')->with('message', "Update Failed");
            }

        } catch ( \Exception $e ) {
            $data = json_decode($e->getBody()->getContents());
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $data->message);

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assistant_id)
    {
    //    $url = env('API_URL', 'https://api.customerpay.me/') . '/assistant/delete/' . $user_id;
    //    $client = new Client();
    //    $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
    //    try {
	//        $delete = $client->delete($url, $headers);

	//       if($delete->getStatusCode() == 200 || $delete->getStatusCode() == 201) {
	// 	    	$request->session()->flash('alert-class', 'alert-success');
    //             Session::flash('message', "Store assistant successfully deleted");
    //             return $this->index();
	//         }
    //     	else if($delete->getStatusCode() == 401){
	// 	    	$request->session()->flash('alert-class', 'alert-danger');
	// 	    	Session::flash('message', "You are not authorized to perform this action, please check your details properly");
    //             return redirect()->route('assistant.index');
	//        }
    //        else if($delete->getStatusCode() == 500){
	// 	   		$request->session()->flash('alert-class', 'alert-danger');
	// 	    	Session::flash('message', "A server error encountered, please try again later");
    //             return redirect()->route('assistant.index');
	//       	}
    //    	  }
    //    	  catch(ClientException $e) {
	// 			$request->session()->flash('alert-class', 'alert-danger');
	// 			Session::flash('message', "A technical error occured, we are working to fix this.");
    //             return redirect()->route('assistant.index');
    //    }

    //update
       $url = env('API_URL', 'https://api.customerpay.me/') . '/assistant/delete/' . $assistant_id;
       $client = new Client();
       $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
       try {
	       $delete = $client->delete($url, $headers);

	      if($delete->getStatusCode() == 200 || $delete->getStatusCode() == 201) {
		    	$request->session()->flash('alert-class', 'alert-success');
                Session::flash('message', "Store assistant successfully deleted");
                return $this->index();
	        }
        	else if($delete->getStatusCode() == 401){
		    	$request->session()->flash('alert-class', 'alert-danger');
		    	Session::flash('message', "You are not authorized to perform this action, please check your details properly");
                return redirect()->route('assistant.index');
	       }
           else if($delete->getStatusCode() == 500){
		   		$request->session()->flash('alert-class', 'alert-danger');
		    	Session::flash('message', "A server error encountered, please try again later");
                return redirect()->route('assistant.index');
	      	}
       	  }
       	  catch(ClientException $e) {
				$request->session()->flash('alert-class', 'alert-danger');
				Session::flash('message', "A technical error occured, we are working to fix this.");
                return redirect()->route('assistant.index');
       }
    }
}
