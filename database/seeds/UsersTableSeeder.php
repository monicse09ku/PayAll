<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();

    	$users = [
            [
                'name' => "Superadmin",
                'email' => 'superadmin@superadmin.com',
                'password' => bcrypt('superAdminP@$$word'),
                'role' => 'superadmin',
                'status' => 'active',
            ],
            [
                'name' => "Admin",
                'email' => 'admin@admin.com',
                'password' => bcrypt('adminP@ssowrd'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => "Reseller Reseller",
                'email' => 'reseller@reseller.com',
                'password' => bcrypt('resellerP@ssowrd'),
                'role' => 'reseller',
                'status' => 'active',
            ],
    	];

    	foreach($users as $user) {
    		User::create($user);
    	}

    }
}
