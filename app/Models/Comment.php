<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Traits\Rating;


class Comment extends Model
{
    use Rating;

    /** @var array The attributes that are mass assignable. */
	protected $fillable = ['text', 'post_id', 'user_id'];

	/** @var int Time, during user can edit own comment */
	public $editTime = 60 * 30;

    /**
     * Get the post of this comment
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function post()
    {
    	return $this->belongsTo('App\Models\Post');
    }


    /**
     * Get the author of this comment
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    /**
     * Get rates of this comment
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function rates()
    {
    	return $this->hasMany('App\Models\CommentsRate');
    }

    /**
     * Checks, is the this comment editable for current user
     *
     * @param \App\Models\User $author User which will be checked
     * @return boolean
     */
    public function isEditable($author)
    {
        $user = (Auth::check()) ? Auth::user() : null;
        
        if ($user) {
            if ($user->hasAnyRole('Admin')) {
                return true;
            }
            if ($user->hasAnyRole('Moderator')) {
                return $this->isOwn() || !$author->hasAnyRole(['Admin', 'Moderator']);
            }
            return $this->isOwn() && (strtotime($this->created_at) + $this->editTime) > time();
        }
        
        return false;
    }

    /**
     * Checks, is the this comment deletable for current user
     *
     * @param \App\Models\User $author User which will be checked
     * @return boolean
     */
    public function isDeletable($author)
    {
        $user = (Auth::check()) ? Auth::user() : null;
        
        if ($user) {
            if ($user->hasAnyRole('Admin')) {
                return true;
            }
            if ($user->hasAnyRole('Moderator')) {
                return $this->isOwn() || !$author->hasAnyRole(['Admin', 'Moderator']);
            }
            return $this->isOwn();
        } else {
            return false;
        }
    }

}
