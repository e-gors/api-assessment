<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // new user information and needed data to be migrate to users table
        $newUser = [
            'name' => "New User",
            'email' => "assessment@gmail.com",
            'password' => Hash::make('assessment@22'),
        ];

        // check first if user already exist.
        $oldUser = User::where('email', $newUser['email'])->first();
        if (!$oldUser) {
            // create new user if not
            User::create($newUser);
        }
    }
}
