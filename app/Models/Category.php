<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name', 'description', 'slug'];

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function tags()
    {
    	return $this->hasMany('App\Models\Tag');
    }

    public function scopeSlug($query, $category)
    {
    	return $query->where('slug', $category);
    }

}
