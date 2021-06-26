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


        $role = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'apoteker',
                'guard_name' => 'web',
            ],
            [
                'name' => 'laboratorium',
                'guard_name' => 'web',
            ],
            [
                'name' => 'pendaftaran',
                'guard_name' => 'web',
            ],
            [
                'name' => 'dokter',
                'guard_name' => 'web',
            ]
        ];

        Role::insert($role);



        $userAdmin = User::create([
            'name' => 'The Admins',
            'email' => 'admin_guard@gmail.com',
            'password' => bcrypt('secretes')
        ]);


        $userAdmin->assignRole('admin');
    }
}
