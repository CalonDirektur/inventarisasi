<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_super_admin = Role::where('name', 'super_admin')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_employee = Role::where('name', 'staff')->first();

        // Periksa apakah role ditemukan
        if ($role_employee) {
            User::create([
                "name" => "ryugen",
                "username" => "ryugen",
                "role_id" =>  $role_employee->id,
                "password" => bcrypt('12345678')
            ]);
        }

        if ($role_admin) {
            User::create([
                "name" => "admin",
                "username" => "admin",
                "role_id" => $role_admin->id,
                "password" => bcrypt('12345678')
            ]);
        }

        if ($role_super_admin) {
            User::create([
                "name" => "super admin",
                "username" => "super_admin",
                "role_id" => $role_super_admin->id,
                "password" => bcrypt('12345678')
            ]);
        }
    }
}
