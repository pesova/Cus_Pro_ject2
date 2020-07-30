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
        return view('backend.payment_details.index');
    }

    /** 
     * show payment form
     */
    public function create()
    {
        return view('backend.payment_details.create');
    }

    /**
     * Instancitate payment
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number' => 'required',
            'card_expiry_month' => 'required|string|max:2',
            'card_expiry_year' => 'required|string|min:3|max:4',
            'card_cvv_number' => 'required|string|min:3|max:3',
        ]);
        
        $input = $request->all();
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if($validator->passes()) {
            try {
                $request->session()->flash('alert-class', 'alert-info');
                $request->session()->flash('message', 'Work in progress');
                return redirect()->back();
            } catch (\Throwable $th) {
                $request->session()->flash('alert-class', 'alert-dange');
                $request->session()->flash('message', 'something went wrong');
                return redirect()->back();
            }
        }
    }
}
