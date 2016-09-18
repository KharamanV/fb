<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['title', 'short', 'slug', 'text', 'img_path'];

    public function scopeSlug($query, $slug)
    {
    	return $query->where('slug', $slug);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
