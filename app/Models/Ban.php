<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    /** @var array The attributes that are mass assignable. */
	protected $fillable = ['user_id', 'blocked_until', 'reason'];

    /**
     * Get the banned user
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
