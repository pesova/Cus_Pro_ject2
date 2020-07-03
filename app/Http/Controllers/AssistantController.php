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
        if ($request->isMethod('post')) {
        return $this->store();
        } else {
            return redirect()->route('assistant.create');
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
        //

        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant/new';

        if ($request->isMethod('post')) {
            $request->validate([
                'phone_number' => 'required',
                'name' =>  'required',
            ]);

            try {

                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'name' => $request->input('name'),
                        'phone_number' => $request->input('phone_number'),
                    ],

                ];

                $response = $client->request("POST", $url, $payload);

                $statusCode = $response->getStatusCode();
                $body = $response->getBody();
                $data = json_decode($body);

                if ($statusCode == 201  && $data->success) {
                    $request->session()->flash('alert-class', 'alert-success');
                    Session::flash('message', $data->message);
                    return redirect()->route('assistant.create');
                } else {
                    $request->session()->flash('alert-class', 'alert-waring');
                    Session::flash('message', $data->message);
                    return redirect()->route('assistant.create');
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
                return redirect()->route('assistant.create');
            } catch (Exception $e) {
                // dd( $e->getMessage());
                Log::error( $e->getMessage());
                return view('errors.500');
            }
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
        return view('backend/assistant/edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
