<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    protected $user_id;
    protected $user_role;

    public function __construct(Request $request)
    {
        $this->user_id = $request['request_user_id'];
        $this->user_role = $request['request_user_role'];
    }

    public function index()
    {

        // dd(Customers::first());
    }
}
