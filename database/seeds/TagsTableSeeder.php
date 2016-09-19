<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
        	[
        		'name'        => 'php',
        		'description' => 'PHP posts'
    		],
        	[
        		'name'        => 'js',
        		'description' => 'JS posts'
    		],
        	[
        		'name'        => 'css',
        		'description' => 'css posts'
    		],
        	[
        		'name'        => 'html',
        		'description' => 'html posts'
    		],
        	[
        		'name'        => 'nodejs',
        		'description' => 'NodeJS posts'
    		],
    	]);
    }
}
