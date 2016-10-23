<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Rating;

class Post extends Model
{
    use Rating, SoftDeletes;
    /** @var array The attributes that should be mutated to dates. */
    protected $dates = ['deleted_at'];

    /** @var array The attributes that are mass assignable. */
    protected $fillable = ['title', 'short', 'slug', 'text', 'img', 'category_id'];

    /**
     * Get the category of this post
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the tags of this post
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * Get the comments of this post
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get the rates of this post
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function rates()
    {
        return $this->hasMany('App\Models\PostsRate');
    }

    /**
     * Scope a query to only include results by specified slug
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $slug Post slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Scope a query ordering results by id desc
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderById($query)
    {
    	return $query->orderBy('id', 'desc');
    }

    /**
     * Scope a query to only include posts whithout category
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutCategories($query)
    {
        return $query->whereNull('category_id');
    }

    /**
     * Scope a query to only include posts whith LIKE title
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $value Post title
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByTitle($query, $value)
    {
        return $query->where('title', 'LIKE', '%' . $value . '%');
    }

}
