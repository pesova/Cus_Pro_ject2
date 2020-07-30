<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /** 
     * show payment page
     */
    public function index()
    {
        return view('backend.payment.index');
    }

    /** 
     * show payment form
     */
    public function create()
    {
        return view('backend.payment.create');
    }

    /**
     * Instancitate payment
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number' => 'required',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required',
            'card_cvv_number' => 'required',
        ]);

        $input = $request->all();
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if($validator->passes()) {
            try {
                dd('here');
            } catch (\Throwable $th) {
                dd('there');
            }
        }
    }
}
