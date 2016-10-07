<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name', 'description', 'slug', 'category_id'];

    public function posts()
    {
    	return $this->belongsToMany('App\Models\Post');
    }

    public function users()
    {
    	return $this->belongsToMany('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function scopeTag($query, $tag)
    {
    	return $query->where('name', $tag);
    }

    public function scopeTags($query, $tags)
    {
        return $query->where($tags);
    }
}
