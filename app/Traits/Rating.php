<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Rating
{
    /**
     * Checks, is the current item is own
     *
     * @return boolean
     */
	public function isOwn()
    {
    	return (Auth::check()) ? Auth::user()->id == $this->user_id : false;
    }

    /**
     * Checks, is the current item is already rated
     *
     * @return boolean
     */
	public function isRated()
    {
    	return (Auth::check()) ? $this->rates()->where('user_id', Auth::user()->id)->first() : false;
    }
}