<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
	public function __construct()
	{
		$this->roles = DB::table('roles')->get();
	}

    /**
     * Defining relation with users model
     * 
     * @return Relation
     */
    public function users()
    {
    	return $this->hasMany('App\Models\User');
    }

    /**
     * Get id of needed role
     * 
     * @param string $role
     * @return int Id of role
     */
    public static function getRoleId($role) {
    	return DB::table('roles')->where('name', $role)->first()->id;
    }
}