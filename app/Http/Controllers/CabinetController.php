<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CabinetController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index() {
    	$user = Auth::user();
    	return view('cabinet.index', ['user' => $user]);
    }
}
