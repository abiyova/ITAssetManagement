<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@assetinsight.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
        ]);
        $superAdmin->assignRole('super-admin');

        $itStaff = User::create([
            'name' => 'IT Staff',
            'email' => 'itstaff@assetinsight.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
        ]);
        $itStaff->assignRole('it-staff');

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@assetinsight.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
        ]);
        $manager->assignRole('manager');

        $auditor = User::create([
            'name' => 'Auditor',
            'email' => 'auditor@assetinsight.com',
            'password' => Hash::make('password'),
            'phone' => '081234567893',
        ]);
        $auditor->assignRole('auditor');
    }
}
