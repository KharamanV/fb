<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentsRate extends Model
{
    /**
     * Get the comment of this rate
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function comment()
    {
    	return $this->belongsTo('App\Models\Comment');
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