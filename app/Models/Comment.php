<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Rating;

class Comment extends Model
{
    use Rating;

	protected $fillable = ['text', 'post_id', 'user_id'];

	/**
	 * 30 minutes to edit comment
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

    public function rates()
    {
    	return $this->hasMany('App\Models\CommentsRate');
    }

    public function isEditable()
    {
    	if ($this->isOwn() && (strtotime($this->created_at) + $this->editTime) > time()) {
    		return true;
    	}
    	return false;
    }

}