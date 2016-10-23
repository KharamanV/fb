<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @var array The attributes that are mass assignable. */
	protected $fillable = ['name', 'description', 'slug'];

    /**
     * Get the posts with this category
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    /**
     * Get the child tags
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function tags()
    {
    	return $this->hasMany('App\Models\Tag');
    }

    /**
     * Scope a query to only include results by specified slug
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $category Category name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, $category)
    {
    	return $query->where('slug', $category);
    }

}
