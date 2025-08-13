<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('role', 'admin')->first();
        if(!$admin) {
        	User::create(
        		[
        			'name'  => 'Admin',
                    'username'=> 'admin',
	        		'email' => 'flippingo@gmail.com',
	        		'role'  => 'admin',              
	        		'password' => \Hash::make('Webmingo123@#')
        		]
        	);
        }
    }
}
