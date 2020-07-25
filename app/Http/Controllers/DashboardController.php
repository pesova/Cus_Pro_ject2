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

class DashboardController extends Controller
{
    protected $host;

    public function __construct()
    {
        $this->host = env('API_URL', 'https://dev.api.customerpay.me');
    }

    public function index()
    {
        // API updated
        if (Cookie::get('user_role') === 'super_admin') {

            $allInfo_url = env('API_URL', 'https://dev.api.customerpay.me') . '/dashboard/all';
            try {
                $client = new Client;
                $payload = [
                    'headers' => [
                        'x-access-token' => Cookie::get('api_token')
                    ]
                ];
                // Transaction endpoint is having issues
                $allInfoResponse = $client->request('GET', $allInfo_url, $payload);

                // Transaction endpoint is having issues
                $status_code_all_info = $allInfoResponse->getStatusCode();

                if ($status_code_all_info == 200) {
                    $allInfo_response_body = json_decode($allInfoResponse->getBody());
                    return view('backend.dashboard.index')->with('response', [$allInfo_response_body]);
                }
            } catch (RequestException $e) {

                return view('backend.dashboard.index')->with('response', null);
            } catch (\Exception $e) {
                return view('errors.500');
            }

            // Jeremiahiro fixed dashboard for store admin
        } elseif (Cookie::get('user_role') === 'store_admin') {
            $transaction_url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/store_admin';
            $customer_url = env('API_URL', 'https://dev.api.customerpay.me') . '/customer';
            $debt_url = env('API_URL', 'https://dev.api.customerpay.me') . '/debt';
            $store_url = env('API_URL', 'https://dev.api.customerpay.me') . '/store';
            $assistant_url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant';

            try {
                $client = new Client;
                $payload = [
                    'headers' => [
                        'x-access-token' => Cookie::get('api_token')
                    ]
                ];

                $transaction_response = $client->request('GET', $transaction_url, $payload);
                $customer_response = $client->request('GET', $customer_url, $payload);
                $debt_response = $client->request('GET', $debt_url, $payload);
                $store_response = $client->request('GET', $store_url, $payload);
                $assistant_response = $client->request('GET', $assistant_url, $payload);

                // Transaction endpoint is having issues
                $transactionStatusCode = $transaction_response->getStatusCode();
                $customerStatusCode = $customer_response->getStatusCode();
                $debtStatusCode = $debt_response->getStatusCode();
                $storeStatusCode = $store_response->getStatusCode();
                $assistantStatusCode = $assistant_response->getStatusCode();

                if ($transactionStatusCode == 200 && $customerStatusCode == 200 && $debtStatusCode == 200  
                    && $storeStatusCode == 200 && $assistantStatusCode == 200) {

                    $transactions = json_decode($transaction_response->getBody())->data->transactions;
                    $customers = json_decode($customer_response->getBody())->data->customer;
                    $debtors = json_decode($debt_response->getBody())->data->debts;
                    $stores = json_decode($store_response->getBody())->data->stores;
                    $assistants = json_decode($assistant_response->getBody())->data->assistants;
                    
                    $totalSpeakers = $debtors(function ($item){
                        $amount = $item['amount'];
                        dd($amount);
                    });
                    // foreach ($debtors as $debtor){
                        // $a = array($debtors()->amount);
                        // dd($a);
                    // }

                    return view('backend.dashboard.index', compact([
                        'transactions', 'customers', 'debtors', 'stores', 'assistants'
                    ]));
                }
            } catch (RequestException $e) {

                Log::info('Catch error: DashboardController - ' . $e->getMessage());
                // check for 5xx server error
                if ($e->getResponse()->getStatusCode() >= 500) {
                    return view('errors.500');
                }
                else {
                    return redirect()->route('logout');
               }

            } catch (\Exception $e) {

                Log::error('Catch error: StoreController - ' . $e->getMessage());
                return view('errors.500');
            }
        } else { // Todo: remove this when dashboard API is available
            try {
                // Get all stores first
                $url = env('API_URL', 'https://dev.api.customerpay.me') . '/assistant/' . Cookie::get('user_id');
                $client = new Client();
                $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
                $response = $client->request("GET", $url, $headers);

                // First get the assistant details

                if ($response->getStatusCode() == 200) {
                    $assistant = json_decode($response->getBody());
                    $assistant = $assistant->data->store_assistant;

                    // Then get the store details

                    $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store/' . $assistant->store_id;
                    $client = new Client();
                    $response = $client->request("GET", $url, $headers);

                    if ($response->getStatusCode() == 200) {
                        $store = json_decode($response->getBody());
                        $store = $store->data->store;

                        // Finally get the transactions
                        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction/store/' . $assistant->store_id;
                        $client = new Client();
                        $response = $client->request("GET", $url, $headers);

                        if ($response->getStatusCode() == 200) {
                            $transactions = json_decode($response->getBody());
                            $transactions = $transactions->data->transactions;

                            // get recent 10 transactions
                            if (count($transactions) > 10) {
                                $transactions = array_slice($transactions, 9);
                            }

                            return view('backend.dashboard.index')->with('assistant', $assistant)->withStore($store)->withTransactions($transactions);

                        } else {
                            return view('errors.500');
                            // return back()->withErrors("An Error Occured. Please try again later");
                        }


                    } else {
                        return view('errors.500');
                        // return back()->withErrors("An Error Occured. Please try again later");
                    }

                } else {
                    return view('errors.500');
                    // return back()->withErrors("An Error Occured. Please try again later");
                }


            } catch (\Exception $e) {
                // dd($e->getCode());
                if ($e->getCode() == 401) {
                    return redirect()->route('logout')->withErrors("Please Login Again");
                }
                return view('errors.500');
                //return $response->getStatusCode();
            }
        }
    }

    public function notification()
    {
        $phone_number = Cookie::get('phone_number');
        $user = User::where('phone_number', $phone_number)->first();
        return view('backend.dashboard.notification')->with([
            'notifications' => $user->notifications,
            'user' => $user
        ]);
    }

    public function creditor()
    {
        return view('backend.dashboard.creditor');
    }

    public function analytics()
    {
        return view('backend.dashboard.analytics');
    }
}
