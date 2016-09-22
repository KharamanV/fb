<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['title', 'short', 'slug', 'text', 'img', 'category_id'];

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeOrderById($query)
    {
    	return $query->orderBy('id', 'desc');
    }

    public function scopeSearchByTitle($query, $value)
    {
        return $query->where('title', 'LIKE', '%' . $value . '%');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Models\Tag');
    }

}
