<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'login', 'role_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function role()
    {
         return $this->belongsTo('App\Models\Role');
    }

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

    protected function hasRole($role) {
        return $this->role()->where('name', $role)->first();
    }

    public function setRoleIdAttribute($value)
    {
        if ($this->isAdmin()) {
            $this->attributes['role_id'] = $value;
        }
    }

    public function setIsActiveAttribute($value)
    {
        if ($this->isAdmin()) {
            $this->attributes['is_active'] = $value;
        }
    }

    public function isAdmin()
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return true;
        }
        return false;
    }
}
