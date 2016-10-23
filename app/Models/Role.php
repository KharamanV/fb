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
	 * Get the users with this role
	 *
	 * @return \Illuminate\Database\Eloquent\Model Relation
	 */
    public function users()
    {
    	return $this->hasMany('App\Models\User');
    }

    /**
     * Get id of needed role
     * 
     * @param string $role Name of role
     * @return int Id of role
     */
    public static function getRoleId($role) {
    	return DB::table('roles')->where('name', $role)->first()->id;
    }
}