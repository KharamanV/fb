<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;


class CabinetController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Shows the user cabinet
     * 
     * @return View
     */
    public function index() {
    	$user = Auth::user();
    	return view('cabinet.index', ['user' => $user]);
    }

    /**
     * Updating account data
     * 
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function update(Request $request)
    {
    	$user = Auth::user();
    	$user->fill($request->all());
    	$user->save();

    	return back();
    }

}