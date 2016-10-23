<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostsRate extends Model
{
    /**
     * Get the post of this rate
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function post()
    {
    	return $this->belongsTo('App\Models\Post');
    }

    /**
     * Get the user of this rate
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
