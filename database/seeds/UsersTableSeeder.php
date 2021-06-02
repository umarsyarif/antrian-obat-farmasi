<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'is_admin' => true,
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'Apoteker',
            'username' => 'apoteker',
            'password' => Hash::make('12345678')
        ]);
    }
}
