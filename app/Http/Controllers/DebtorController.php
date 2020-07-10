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
        return view('backend.debtor.create');
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
        return view('backend.debtor.create');

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
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/debt/delete/'. $id;

        try {

            $client = new Client();
            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => ['debt_id' => $id]
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
