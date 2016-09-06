<?php

use Illuminate\Database\Seeder;

class UsersTableAddAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'login' => 'admin',
        	'name' => 'Admin',
        	'last_name' => 'Admin',
        	'email' => 'admin@admin.com',
       		'password' => bcrypt('admin'),
       		'role_id' => 1
    	]);
    }
}
