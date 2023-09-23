<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // support admin
        User::create([
            'type' => UserType::SupportAdmin,
            'name' => 'Support Admin',
            'email' => 'admin@support.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(20),
        ]);

        // support staff
        // User::create([
        //     'type' => UserType::SupportStaff,
        //     'name' => 'Support Staff',
        //     'email' => 'staff@support.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'),
        //     'remember_token' => Str::random(20),
        // ]);

        // support account
        // User::create([
        //     'type' => UserType::SupportAccount,
        //     'name' => 'Support Account',
        //     'email' => 'account@support.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'),
        //     'remember_token' => Str::random(20),
        // ]);

        // company
        // User::create([
        //     'type' => UserType::Company,
        //     'name' => 'Company',
        //     'email' => 'company@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'),
        //     'remember_token' => Str::random(20),
        // ]);
    }
}
