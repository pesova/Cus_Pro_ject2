<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
	public function index(){

		return view('website.complaint');
	}
}


