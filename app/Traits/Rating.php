<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Rating
{
	public function isOwn()
    {
    	return (Auth::check()) ? Auth::user()->id == $this->user_id : false;
    }

	public function isRated()
    {
    	return (Auth::check()) ? $this->rates()->where('user_id', Auth::user()->id)->first() : false;
    }
}