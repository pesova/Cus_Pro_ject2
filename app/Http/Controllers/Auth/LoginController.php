<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

// use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $host;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->host = env('API_URL', 'https://api.customerpay.me/');
    }

    public function index()
    {
        if (Cookie::get('api_token')) {
            return redirect()->route('dashboard');
        }
        return view('backend.login');
    }

    public function authenticate(Request $request)
    {
        $validation = Validator::make(request()->all(), [
            'phone_number' => 'required|min:6|max:16',
            'password' => 'required|regex:/[a-zA-Z0-9]{6,20}$/'
        ]);

        if ($validation->fails()) {
            $request->session()->flash('message', 'Invalid Phone number or password');
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect()->route('login');
        }

        try {
            $client =  new \GuzzleHttp\Client();
            $response = $client->post($this->host . '/login/user', [
                'form_params' => [
                    'phone_number' => $request->input('phone_number'),
                    'password' => $request->input('password')
                ]
            ]);

            if ($response->getStatusCode() == 200) {

                $response = json_decode($response->getBody());

                if (isset($response->success) && $response->success) {

                    $data = $response->data->user->local;

                    // store data to cookie
                    Cookie::queue('api_token', $data->api_token);
                    Cookie::queue('is_active', $data->is_active);
                    Cookie::queue('phone_number', $data->phone_number);
                    Cookie::queue('user_id', $response->data->user->_id);
                    Cookie::queue('expires', strtotime('+ 1 day'));

                    $request->session()->flash('alert-class', 'alert-success');
                    $request->session()->flash('message', $response->message);

                    //check if active
                    if ($data->is_active == false) {
                        return redirect()->route('activate.user');
                    }

                    return redirect()->route('dashboard');
                } else {
                    $message = isset($response->Message) ? $response->Message : $response->message;
                    $request->session()->flash('message', $message);
                    return redirect()->route('login');
                }
            }

            $message = isset($response->Message) ? $response->Message : $response->message;
            $request->session()->flash('message', $message);
            return redirect()->route('login');
        } catch (\Exception $e) {

            if ($e->getCode() == 400) {
                $request->session()->flash('message', 'Invalid Phone number or password. Ensure Your phone number uses internations format.e.g +234');
                $request->session()->flash('alert-class', 'alert-danger');
                return redirect()->route('login');
            }

            Log::error("catch error: LoginController - " . $e->getMessage());
            $request->session()->flash('message', $e->getMessage());
            return redirect()->route('login');
        }
        return redirect()->route('login');
    }
}
