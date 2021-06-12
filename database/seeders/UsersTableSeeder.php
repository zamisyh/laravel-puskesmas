<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $userAdmin = User::create([
            'name' => 'The Admins',
            'email' => 'admin_guard@gmail.com',
            'password' => bcrypt('secretes')
        ]);


        $userAdmin->assignRole('admin');


    }
}
