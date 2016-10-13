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
     * Defining relation to role model
     * 
     * @return Relation
     */
    public function role()
    {
         return $this->belongsTo('App\Models\Role');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function ban()
    {
        return $this->hasOne('App\Models\Ban');
    }

    /**
     * Checks, is the user has needed role
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
     * Checks, is the user has needed role
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
     * @param $value
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
     * @param $value
     * @return void
     */
    public function setIsActiveAttribute($value)
    {
        if ((Auth::check() && $this->isAdmin()) || UserActivation::where('user_id', $this->id)) {
            $this->attributes['is_active'] = $value;
        }
    }

    /**
     * Checks, is the current user - admin
     * 
     * @return boolean
     */
    public function isAdmin()
    {
        return Auth::user()->hasAnyRole('Admin');
    }

    public function scopeUsername($query, $username)
    {
        return $query->where('login', $username);
    }

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

    public function isBanned()
    {
        return $this->ban_id;
    }

    public function unBan()
    {
        return $this->ban->delete();
    }

    public function shouldUnBan()
    {
        //If ban period is over
        return strtotime($this->ban->blocked_until) < time();
    }

    
}
