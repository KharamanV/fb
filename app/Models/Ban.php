<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
	protected $fillable = ['user_id', 'blocked_until', 'reason'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
