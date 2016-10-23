<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

use App\Models\Role;
use App\Models\UserActivation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'login', 'role_id', 'is_active', 'age', 'city', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Get the role of this user
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function role()
    {
         return $this->belongsTo('App\Models\Role');
    }

    /**
     * Get the comments of this user
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get the subscribe tags of this user
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * Get the ban record of this user
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function ban()
    {
        return $this->hasOne('App\Models\Ban');
    }

    /**
     * Get the post rates of this user
     *
     * @return \Illuminate\Database\Eloquent\Model Relation
     */
    public function postRates()
    {
        return $this->hasMany('App\Models\PostsRate');
    }

    /**
     * Checks, is the user has specified role/roles
     * 
     * @param string/array $roles
     * @return boolean
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }
    /**
     * Checks, is the user has specified role
     * 
     * @param string $role
     * @return boolean
     */
    protected function hasRole($role) {
        return $this->role()->where('name', $role)->first();
    }

    /**
     * Setter/Mutator for role_id column
     * 
     * @param int $value
     * @return void
     */
    public function setRoleIdAttribute($value)
    {
        if (Auth::check() && $this->isAdmin()) {
            $this->attributes['role_id'] = $value;
        }
    }

    /**
     * Setter/Mutator for is_active column
     * 
     * @param int $value
     * @return void
     */
    public function setIsActiveAttribute($value)
    {
        if ((Auth::check() && $this->isAdmin()) || UserActivation::where('user_id', $this->id)) {
            $this->attributes['is_active'] = $value;
        }
    }

    /**
     * Checks, is the current user is admin
     * 
     * @return boolean
     */
    public function isAdmin()
    {
        return Auth::user()->hasAnyRole('Admin');
    }

    /**
     * Checks, is the current user can ban specified user
     *
     * @param \App\Models\User $user
     * @return boolean
     */
    public function hasBanPermissions($user)
    {
        if ($this->hasAnyRole('Admin') && !$user->hasAnyRole('Admin')) {
            return true;
        }

        if ($this->hasAnyRole('Moderator') && !$user->hasAnyRole(['Admin', 'Moderator'])) {
            return true;
        }

        return false;
    }

    /**
     * Checks, is the current has been banned
     *
     * @return int|null
     */
    public function isBanned()
    {
        return $this->ban_id;
    }

    /**
     * Unban user
     *
     * @return boolean
     */
    public function unBan()
    {
        return $this->ban->delete();
    }

    /**
     * Checks, is the ban period is over
     *
     * @return boolean
     */
    public function shouldUnBan()
    {
        //If ban period is over
        return strtotime($this->ban->blocked_until) < time();
    }

    /**
     * Scope a query to only include user with specified login
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsername($query, $username)
    {
        return $query->where('login', $username);
    }

    
}
