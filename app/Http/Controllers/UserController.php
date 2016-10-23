<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Displays specified user profile
     *
     * @param string $username Username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::username($username)->firstOrFail();
        
        return view('users.show', ['user' => $user]);
    }

    /**
     * Displays 'Banned' page for banned users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showBannedMessage(Request $request)
    {
    	$user = $request->user();
        
    	return view('banned', ['user' => $user]);
    }
}
