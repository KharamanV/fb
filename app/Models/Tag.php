<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @var array The attributes that are mass assignable. */
	protected $fillable = ['name', 'description', 'slug', 'category_id'];

    /**
     * Get the posts with this tag
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function posts()
    {
    	return $this->belongsToMany('App\Models\Post');
    }

    /**
     * Get the users which subscribe to this tag
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function users()
    {
    	return $this->belongsToMany('App\Models\User');
    }

    /**
     * Get the category with this tag
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Scope a query to only include tag where it name equals specified value
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $tag Tag name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTag($query, $tag)
    {
    	return $query->where('name', $tag);
    }

    /**
     * Scope a query to only include tags where tag name equals specified value
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $tags Tag names
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTags($query, $tags)
    {
        return $query->where($tags);
    }
}
