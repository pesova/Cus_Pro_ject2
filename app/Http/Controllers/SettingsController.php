<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
class SettingsController extends Controller
{
    // Defining headers
    public $headers;
    public $user_id;

    public function __construct()
    {
        $this->user_id = Cookie::get('user_id');
    }

    // Controller action to display settings page.
    public function index()
    {
        // User Data
        $user_details = [];
        $user_details['id'] = Cookie::get('user_id');
        $user_details['email'] = Cookie::get('email');
        $user_details['first_name'] = Cookie::get('first_name');
        $user_details['last_name'] = Cookie::get('last_name');
        $user_details['account_name'] = Cookie::get('account_name');
        $user_details['account_number'] = Cookie::get('account_number');
        $user_details['account_bank'] = Cookie::get('account_bank');
        $user_details['phone_number'] = Cookie::get('phone_number');
        $user_details['is_active'] = Cookie::get('is_active');

        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/banks/list';
        try {
            $client = new Client();
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $bank_list = $client->request('GET', $url, $headers);
            $statusCode = $bank_list->getStatusCode();

            if ($statusCode == 200) {
                $bank_list = json_decode($bank_list->getBody())->data;
                usort($bank_list, function ($a, $b) {
                    return strcasecmp($a->name, $b->name);
                });
            } else {
                $bank_list = [];
            }
        } catch (RequestException $e) {
            Log::info('Catch error: settingsController - ' . $e->getMessage());
            // token expired
            if ($e->getCode() == 401) {
                Session::flash('message', 'session expired');
                return redirect()->route('logout');
            }
            // get response to catch 4 errors
            if ($e->hasResponse()) {
                $response = $e->getResponse()->getBody();
                $result = json_decode($response);
                Session::flash('message', 'could not retrieve bank list');
                return back();
            }
            $bank_list = [];
        } catch (Exception $e) {
            // token expired
            if ($e->getCode() == 401) {
                Session::flash('message', 'session expired');
                return redirect()->route('logout');
            }
            Log::error('Catch error: seetingsController - ' . $e->getMessage());
            return view('errors.500');
        }

        return view('backend.settings.settings', compact('user_details', 'bank_list'));
    }

    // Controller action to update user details.
    public function update(Request $request)
    {

        try {
            // check if all fields are available
            if ($request->all()) {
                $control = $request->input('control', '');

                if ($control == 'profile_update') {

                    $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store-admin/update';
                    $client = new Client();
                    $data = [
                        "first_name" => $request->input('first_name'),
                        "last_name" => $request->input('last_name'),
                        "email" => $request->input('email'),
                    ];
                    // make an api call to update the user_details
                    $this->headers = ['headers' => ['x-access-token' => Cookie::get('api_token')], 'form_params' => $data];
                    $response = $client->request('PUT', $url, $this->headers);
                } elseif ($control == 'password_change') {
                    $request->validate([
                        'current_password' => 'required|min:6',
                        'new_password' => 'required|min:6|confirmed',
                    ]);
                    $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store-admin/update/password';
                    $client = new Client();
                    $data = [
                        "old_password" => $request->input('current_password'),
                        "new_password" => $request->input('new_password'),
                        "confirm_password" => $request->input('new_password_confirmation')
                    ];
                    // make an api call to update the user_details
                    $this->headers = ['headers' => ['x-access-token' => Cookie::get('api_token')], 'form_params' => $data];
                    $response = $client->request('POST', $url, $this->headers);
                } elseif ($control == 'finance_update') {
                    $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store-admin/update';
                    $client = new Client();
                    $data = [
                        "account_number" => $request->input('account_number'),
                        "account_name" => $request->input('account_name'),
                        "bank" => $request->input('bank'),
                        "currency" => $request->input('currency'),
                    ];
                    // make an api call to update the user_details
                    $this->headers = ['headers' => ['x-access-token' => Cookie::get('api_token')], 'form_params' => $data];
                    $response = $client->request('PUT', $url, $this->headers);
                
                } else {
                    return view('errors.404');
                }
                if ($response->getStatusCode() == 200) {
                    $request->session()->flash('alert-class', 'alert-success');
                    if ($control != 'password_change') {
                        $user_detail_res = json_decode($response->getBody(), true);
                        $filtered_user_detail = $user_detail_res['data']['store_admin']['local'];
                        $bank_details = $user_detail_res['data']['store_admin']['bank_details'];
                        $bank_details['account_name'] = isset($bank_details['account_name']) ? $bank_details['account_name'] : "";
                        $bank_details['account_number'] = isset($bank_details['account_number']) ? $bank_details['account_number'] : "";
                        $bank_details['bank'] = isset($bank_details['bank']) ? $bank_details['bank'] : "";
                        $user_details = [
                            "email" => $filtered_user_detail['email'],
                            "phone_number" => $filtered_user_detail['phone_number'],
                            "first_name" => $filtered_user_detail['first_name'],
                            "last_name" => $filtered_user_detail['last_name'],
                            "account_name" => $bank_details['account_name'],
                            "account_number" => $bank_details['account_number'],
                            "bank" => $bank_details['bank'],

                            "is_active" => Cookie::get('is_active')
                        ];
                        Cookie::queue('phone_number', $filtered_user_detail['phone_number']);
                        Cookie::queue('first_name', $filtered_user_detail['first_name']);
                        Cookie::queue('email', $filtered_user_detail['email']);
                        Cookie::queue('last_name', $filtered_user_detail['last_name']);
                        Cookie::queue('account_name', $bank_details['account_name']);
                        Cookie::queue('account_number', $bank_details['account_number']);
                        Cookie::queue('bank', $bank_details['bank']);
                        $request->session()->flash('message', "Profile details updated successfully");
                        return back();
                    }
                    if ($control == 'password_change') {
                        $request->session()->flash('message', "Password updated successfully");
                    }
                    return back();

                }
            } else {
                return redirect()->route('setting');
            }
        } catch (RequestException $e) {

            if ($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody());
                $request->session()->flash('alert-class', 'alert-danger');
                if ($response->message == 'Error updating password') {
                    $request->session()->flash('message', 'current password is incorrect');
                } else {
                    $request->session()->flash('message', $response->message);
                }
            }

            if ($control == 'password_change') {
                return redirect(route('setting') . '#change-password');
            }
            if ($control == 'profile_update') {
                return redirect()->route('setting');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return view('errors.500');
        }
    }

    public function change_password()
    {
        return view('backend.change_password.index');
    }

    public function displaypicture(Request $request)
    {
        $request->validate([
            'picture' => 'required',
        ]);
        $allowedfileExtension=['jpg','png','jpeg'];
        
        $image = $request['picture'];
        $extension = $image->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if ($check){
            $filename    = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());     
            $image_resize->resize(200, 200);
            $url = env('API_URL', 'https://dev.api.customerpay.me') . '/store_admin/update';
            $client = new Client();
            $this->client->request('PUT', $url, [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
            ],
                'multipart' => [
                    [
                    'name' => 'image',
                    'contents' => $image_resize->save(('image'))
                    ]
                ]
                ]);
            $statusCode = $this->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($this->getBody())->data;
                return response()->json([
                    'status'  => 'success',
                    'message' => 'verified successfully',
                    'data'    => $data,
                ],200);
            }
            
              
        }else{
        // return $extension;
        return response()->json(['status'=>false,'message' => 'invalid account details'],400);
        }
                  
        // return redirect()->back();
    }

    public function verify_bank(Request $request)
    {
        $url = env('API_URL', 'https://dev.api.customerpay.me') . '/account/verify';
        try {
            $client = new Client();
            $headers = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => $request->all(),
            ];
            $response = $client->request('POST', $url, $headers);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody())->data;
                return response()->json([
                    'status'  => 'success',
                    'message' => 'verified successfully',
                    'data'    => $data,
                ],200);
            }
            return response()->json(['status'=>false,'message' => 'invalid account details'],400);
        } catch (RequestException $e) {
            Log::info('Catch error: settingsController - ' . $e->getMessage());
            // token expired
            return response()->json(['status'=>false,'message' => 'invalid account details'],400);
        } catch (Exception $e) {
            Log::error('Catch error: seetingsController - ' . $e->getMessage());
            return response()->json(['status'=>false,'message' => 'internal error'],400);
        }

    }
}
