<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::username($username)->firstOrFail();
        return view('users.show', ['user' => $user]);
    }

    public function showBannedMessage(Request $request)
    {
    	$user = $request->user();
    	return view('banned', ['user' => $user]);
    }
}
