<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Rating;

class Post extends Model
{
    use Rating, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'short', 'slug', 'text', 'img', 'category_id'];

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeOrderById($query)
    {
    	return $query->orderBy('id', 'desc');
    }

    public function scopeWithoutCategories($query)
    {
        return $query->whereNull('category_id');
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

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\PostsRate');
    }

}
