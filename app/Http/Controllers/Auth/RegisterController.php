<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->host = env('API_URL', 'https://api.customerpay.me/');
    }


    public function index()
    {
        if (Cookie::get('api_token')) {
            return redirect()->route('dashboard');
        }
        return view('backend.register.signup');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // Controller action to register a new user.
    public function register(Request $request)
    {

        $request->validate([
            'phone_number' => 'required|min:6|max:17',
            'password' =>  'required|regex:/[a-zA-Z0-9]{6,20}$/',
        ]);

        try {

            if ($request->all()) {

                $client =  new Client();
                $response = $client->post($this->host . '/register/user', [
                    'form_params' => [
                        'phone_number' => $request->input('phone_number'),
                        'password' => $request->input('password')
                    ]
                ]);


                if ($response->getStatusCode() == 201) {

                    $res = json_decode($response->getBody());

                    if ($res->success) {

                        $data = $res->data->user->local;

                        // store data to cookie
                        Cookie::queue('api_token', $data->api_token);
                        Cookie::queue('is_active', $data->is_active);
                        Cookie::queue('phone_number', $data->phone_number);
                        Cookie::queue('user_id', $res->data->user->_id);
                        Cookie::queue('expires', strtotime('+ 1 day'));

                        return redirect()->route('activate.user');
                    }
                }

                if($response->getStatusCode() == 200) {
                    $_response = json_decode($response->getBody(), true);

                    if (count($_response) == 1) {
                        $request->session()->flash('message', $_response['Message']);
                        $request->session()->flash('alert-class', 'alert-danger');
                        return redirect()->route('signup');
                    }
                }
            }

            $res = json_decode($response->getBody());
            $request->session()->flash('message', $res->Message);
            $request->session()->flash('alert-class', 'alert-danger');

            return redirect()->route('signup');
        } catch (\Exception $e) {
            //log error
            Log::error('Catch error: RegisterController - ' . $e->getMessage());

            if ($e->getCode() == 400 || $e->getCode() == 401) {
                $request->session()->flash('message', $e->getMessage());
                $request->session()->flash('alert-class', 'alert-danger');
                return redirect()->route('signup');
            }
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $e->getMessage());
            return redirect()->route('signup');
        }
    }
}
