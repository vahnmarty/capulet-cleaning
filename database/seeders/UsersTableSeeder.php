<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@capulet.com',
            'password' => bcrypt('password')
        ]);

        $super->assignRole('superadmin');


        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@capulet.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');


        $cleaner = User::create([
            'name' => 'Cleaner',
            'email' => 'cleaner@capulet.com',
            'password' => bcrypt('password')
        ]);

        $cleaner->assignRole('cleaner');

        $qc = User::create([
            'name' => 'Quality Control',
            'email' => 'qc@capulet.com',
            'password' => bcrypt('password')
        ]);

        $qc->assignRole('qc');
    }
}
