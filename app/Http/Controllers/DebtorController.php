<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //display my stores
        $store_url = env('API_URL', 'https://dev.api.customerpay.me') . '/store';

        $cl = new Client;
        $payloader = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

        $resp = $cl->request("GET", $store_url, $payloader);
        $statsCode = $resp->getStatusCode();
        $body_response = $resp->getBody();
        $Stores = json_decode($body_response);

        if($statsCode == 200) {
            return view('backend.debtor.index')->with('response', $Stores->data->stores);
        }
        else if($statsCode->getStatusCode() == 500){
            return view('errors.500');
        }

        // return view('backend.debtor.index');
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/debt';

        try {

            $client = new Client();
            $payload = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

            $response = $client->request("GET", $url, $payload);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $body = $response->getBody();
                $result = json_decode($body);
                $debts = $result->data->debts;

                $perPage = 10;
                $debts = collect($debts);

                $page = $request->get('page') ?: (Paginator::resolveCurrentPage() ?: 1);
                $debts = $debts instanceof Collection ? $debts : Collection::make($debts);
                $debtors = new LengthAwarePaginator($debts->forPage($page, $perPage), $debts->count(), $perPage, $page);
                return view('backend.debtor.index', compact('debtors'));
            }

            Session::flash('message', "Temporarily unable to get all stores");
            return view('backend.debtor.index', []);
        } catch (RequestException $e) {
            Log::info('Catch error: LoginController - ' . $e->getMessage());

            if ($e->hasResponse()) {
                $response = $e->getResponse()->getBody();
                $result = json_decode($response);
                Session::flash('message', $result->message);
                return view('backend.debtor.index', []);
            }

            //5xx server error
            return view('errors.500');
        } catch (\Exception $e) {
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
        $store_url = env('API_URL', 'https://dev.api.customerpay.me') . '/store';

        $cl = new Client;
        $payloader = ['headers' => ['x-access-token' => Cookie::get('api_token')]];

        $resp = $cl->request("GET", $store_url, $payloader);
        $statsCode = $resp->getStatusCode();
        $body_response = $resp->getBody();
        $Stores = json_decode($body_response);

        if($statsCode == 200) {
            return view('backend.debtor.create')->with('response', $Stores->data->stores);
        }
        else if($statsCode->getStatusCode() == 500){
            return view('errors.500');
        }
        // return view('backend.debtor.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/debt/new';

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:2',
                'store_name' => 'required|min:2',
                'customer_phone_number' =>  'required',
                'amount' =>  'numeric|required',
                'status' =>  'required',
                'transaction_id' =>   'required',
                'pay_date' =>   'required',
            ]);

            try {

                $client =  new Client();
                $payload = [
                    'headers' => ['x-access-token' => Cookie::get('api_token')],
                    'form_params' => [
                        'name' => $request->input('name'),
                        'store_name' => $request->input('store_name'),
                        'customer_phone_number' => $request->input('customer_phone_number'),
                        'amount' => $request->input('amount'),
                        'status' => $request->input('status'),
                        'transaction_id' => $request->input('transaction_id'),
                        'pay_date' => $request->input('pay_date'),
                        'message' => $request->input('message'),
                    ],

                ];

                $response = $client->request("POST", $url, $payload);

                $statusCode = $response->getStatusCode();
                $body = $response->getBody();
                $data = json_decode($body);

                if ($statusCode == 201  && $data->success) {
                    $request->session()->flash('alert-class', 'alert-success');
                    Session::flash('message', $data->message);

                    return $this->index();
                }
                else if($statusCode->getStatusCode() == 401){
                    $request->session()->flash('alert-class', 'alert-danger');
                    Session::flash('message', "Your Session Has Expired, Please Login Again");
                   return redirect()->route('store.index');
               } else {
                    $request->session()->flash('alert-class', 'alert-waring');
                    Session::flash('message', $data->message);
                    return redirect()->route('debtor.create');
                }
            } catch (RequestException $e) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();

                if ($statusCode  == 500) {
                    Log::error((string) $response->getBody());
                    return view('errors.500');
                }

                $data = json_decode($response->getBody());
                Session::flash('message', $data->message);
                return redirect()->route('debtor.create');
            } catch (Exception $e) {
                Log::error((string) $response->getBody());
                return view('errors.500');
            }
        }

        return view('backend.debtor.create');
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
        return view('backend.debtor.show');
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
        return view('backend.debtor.edit');

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
    public function destroy(Request $request,$id)
    {
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/debt/delete/'. $id;
        $data = $request->all();
        $data['debt_id'] = $id;

        try {

            $client = new Client();
            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => $data,
            ];

            $response = $client->request("DELETE", $url, $payload);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $body = $response->getBody();
                $result = json_decode($body);
                Session::flash('message', $result->message);
            }
                return redirect()->route('debtor.index');
        }  catch (RequestException $e) {
            Log::info('Catch error: LoginController - ' . $e->getMessage());

            if ($e->hasResponse()) {
                $response = $e->getResponse()->getBody();
                $result = json_decode($response);
                Session::flash('message', $result->message);
                return redirect()->route('debtor.index');
            }

            //5xx server error
            Session::flash('message', 'Request was unssucessful. Retry in a few minutes');
            return redirect()->route('debtor.index');
        } catch (\Exception $e) {
            Log::error('Catch error: StoreController - ' . $e->getMessage());
            return view('errors.500');
        }
    }
}
