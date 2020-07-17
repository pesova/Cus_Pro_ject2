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
        } else {
            $transaction_url = env('API_URL', 'https://dev.api.customerpay.me') . '/transaction';
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

                // Transaction endpoint is having issues
                $transaction_response = $client->request('GET', $transaction_url, $payload);
                $customer_response = $client->request('GET', $customer_url, $payload);
                $debt_response = $client->request('GET', $debt_url, $payload);
                $store_response = $client->request('GET', $store_url, $payload);
                $assistant_response = $client->request('GET', $assistant_url, $payload);

                // Transaction endpoint is having issues
                $status_code_transaction_response = $transaction_response->getStatusCode();
                $status_code_customer_response = $customer_response->getStatusCode();
                $status_code_debt_response = $debt_response->getStatusCode();
                $status_code_store_response = $store_response->getStatusCode();
                $status_code_assistant_response = $assistant_response->getStatusCode();

                if ($status_code_transaction_response == 200 && $status_code_customer_response == 200 && $status_code_debt_response == 200 && $status_code_store_response == 200 && $status_code_assistant_response == 200) {

                    $transaction_response_body = json_decode($transaction_response->getBody());
                    $customer_response_body = json_decode($customer_response->getBody());
                    $debt_response_body = json_decode($debt_response->getBody());
                    $store_response_body = json_decode($store_response->getBody());
                    $assistant_response_body = json_decode($assistant_response->getBody());

                    return view('backend.dashboard.index')->with('response', [$transaction_response_body, $customer_response_body, $debt_response_body, $store_response_body, $assistant_response_body]);
                }
            } catch (RequestException $e) {

                return view('backend.dashboard.index')->with('response', null);
            } catch (\Exception $e) {

                return view('errors.500');
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
