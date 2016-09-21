<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function scopeSlug($query, $category)
    {
    	return $query->where('slug', $category);
    }
}
