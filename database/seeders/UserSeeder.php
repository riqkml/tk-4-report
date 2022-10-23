<?php

namespace Database\Seeders;

use App\Http\UserType;
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::query()->updateOrCreate([
            'email' => 'hakimirfan90@gmail.com'
        ], [
            'password' => Hash::make("123"),
            'gender' => UserType::GENDER_L,
            'type' => UserType::STAFF
        ]);

        Users::query()->updateOrCreate([
            'email' => 'buyers1@gmail.com',
        ], [
            'name' => 'buyers+1',
            'password' => Hash::make("123"),
            'gender' => UserType::GENDER_L,
            'type' => UserType::BUYER,
            'address' => 'jakarta'
        ]);

        Users::query()->updateOrCreate([
            'email' => 'buyers2@gmail.com',
        ], [
            'name' => 'buyers+2',
            'password' => Hash::make("123"),
            'gender' => UserType::GENDER_L,
            'type' => UserType::BUYER,
            'address' => 'jakarta'
        ]);
    }
}
