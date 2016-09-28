<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
	protected $fillable = ['text', 'post_id', 'user_id'];

	/**
	 * 15 minutes to edit comment
	 * 
	 * @var int $editTime
	 */
	public $editTime = 60 * 30;

    public function post()
    {
    	return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function isOwn()
    {
    	return Auth::user()->id == $this->user_id;
    }

    public function isEditable()
    {
    	if ($this->isOwn() && (strtotime($this->created_at) + $this->editTime) > time()) {
    		return true;
    	}
    	return false;
    }

    public function isRateable()
    {
    	if (!$this->isOwn()) {

    	}
    }

}
