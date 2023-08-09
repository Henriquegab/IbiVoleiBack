<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {


        $usuario = Role::create([
            'guard_name' => 'api',
            'name' => 'Usuario',
        ]);

        $admin = Role::create([
            'guard_name' => 'api',
            'name' => 'Admin',
        ]);




        $admin_user = User::create([
            'name' => 'Admin',
            'email' => 'genesis@admin.com',
            'password' => bcrypt('Genesis@admin'),


        ]);
        $super_user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'super@admin.com',
            'password' => bcrypt('Genesis@super'),


        ]);

        $admin_user->assignRole('Usuario');
        $super_user->assignRole('Admin');
    }
}
