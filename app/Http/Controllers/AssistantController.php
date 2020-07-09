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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // try {
        //     $user_id = Cookie::get('user_id');
        //     $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistants';
        //     //$url = "http://localhost:3000/user/all/" . $user_id;
        //     $client = new Client();
        //     $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
        //     $user_response = $client->request('GET', $url, $headers);
        //     if ($user_response->getStatusCode() == 200) {
        //         $response = json_decode($user_response->getBody(), true);
        //         // $assistants = $response['data']['assistants'];
        //         // $perPage = 10;
        //         // $page = $request->get('page', 1);
        //         // if ($page > count($assistants) or $page < 1) {
        //         //     $page = 1;
        //         // }
        //         // $offset = ($page * $perPage) - $perPage;
        //         // $articles = array_slice($assistants, $offset, $perPage);
        //         // $datas = new Paginator($articles, count($assistants), $perPage);
        //        // return view('backend.assistant.index')->with('response', $datas->withPath('/' . $request->path()));
        //        return view('backend.assistant.index')->with('response', $assistants);
        //     }
        //     if ($user_response->getStatusCode() == 500) {
        //         return view('errors.500');
        //     }
        // } catch (\Exception $e) {
        //     $request->session()->flash('message', 'Sorry could not get assistants, please check your connection');
        //     return view('backend.assistant.index');
        // }


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
 
 
             return redirect()->route('assistants.index', ['response' => []]);
 
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
        return view('backend/assistant/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant/new';

      try{
          $client = new Client;

          $request->validate([
              'name' => "required|min:6",
              'phone_number' => "required",
              //'store_name' => "required",
              'email' => "required|email",
              'password' => "required"
          ]);

          $payload = [
            'headers' => ['x-access-token' => Cookie::get('api_token')],
            'form_params' => [
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                //'store_name' => $request->input('store_name'),
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
          ];

          $res = $client->post($url, $payload);

          $status = $res->getStatusCode();
          $body = $res->getBody();
          $data = json_decode($body);

          if ($status == 200){
            $request->session()->flash('alert-class', 'alert-success');
            Session::flash('message', $data->message);
            return redirect()->route("assistants.index");
           // return view("backend.assistant.create")->with("message", "success");
           
          } else if($statusCode->getStatusCode() == 401){
            $request->session()->flash('alert-class', 'alert-danger');
            Session::flash('message', "You are not authorized to perform this action, please check your details properly");
           return redirect()->route('assistants.index');
          }else {
            $request->session()->flash('alert-class', 'alert-waring');
            Session::flash('message', $data->message);
            return redirect()->route('assistants.create');
        }

      }catch(\RequestException $e){
        $res = $e->getResponse();
        $statusCode = $res->getStatusCode();

        if ($statusCode  == 500) {
            Log::error((string) $res->getBody());
            return view('errors.500');
        }
            $data = json_decode($res->getBody());
            Session::flash('message', $data->message);
            return redirect()->route('assistants.create');
        } 
        return view('backend.assistant.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = env('API_URL', 'https://dev.api.customerpay.me/') . 'assistant/' . $id;

        try {
            $client = new Client;
            $payload = [
                'headers' => [
                    'x-access-token' => Cookie::get('api_token')
                ],
                'form_params' => [
                    'current_user' => Cookie::get('user_id'),
                ]
            ];

            $res = $client->request('GET', $url, $payload);
            $status = $res->getStatusCode();
            $body = $res->getBody();
            $data = json_decode($body)->data->store;

            if($status == 200){
                //Note: Display for Single Assistant not ready yet
                //return view('backend.assistant.show')->with('response', $StoreData);
            }else {
                return view('errors.500');
            }
        }catch(\RequestException $e){
            Log::info('Catch error: LoginController - ' . $e->getMessage());

            // check for 5xx server error
            if ($e->getResponse()->getStatusCode() >= 500) {
                return view('errors.500');
            }
            // get response to catch 4xx errors
            $response = json_decode($e->getResponse()->getBody());
            Session::flash('alert-class', 'alert-danger');
            // dd($response);
            Session::flash('message', $response->message);
            return redirect()->route('store.index', ['response' => []]);

        }catch (\Exception $e) {
            //log error;
            Log::error('Catch error: StoreController - ' . $e->getMessage());
            return view('errors.500');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.assistant.edit');
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
        $url = env('API_URL', 'https://api.customerpay.me/') . '/assistant/update/' . $id;
       
        
        try{
            $request->validate([
                'name' => 'required',
                'phone_number' => 'required',
            ]);

            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $data = [    
                $headers,        
                'form_params' => [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
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

        }catch ( \Exception $e ){
            return view('errors.500');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
       $url = env('API_URL', 'https://api.customerpay.me/') . '/assistant/delete/' . $user_id;
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
