<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Models\Customers;
use Exception;
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

    public function index(Request $request, $store_id)
    {
        $start          =  $request->get('page') ?? 0;
        $length         = $request->get('length') ?? 10;
        $draw           = $request->get('draw') ?? 1;
        $search         = $request->get('search');

        try {
            $result = Customers::ofStore($store_id)
                ->search($search['value'])
                ->skip($start)
                ->take($length)
                ->get();

            $recordsTotal = Customers::ofStore($store_id)->count();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to get resources',
                'data'    => ['description' => $e->getMessage()]
            ], 400);
        }

        $result = (new CustomerCollection($result ?? []))
            ->additional([
                'draw' => $draw + 1,
                'recordsTotal' => $recordsTotal ?? 0,
            ]);
        return $result;
    }
}
