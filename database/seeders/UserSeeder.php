<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->delete();
        User::create([
            'name' => 'Abdelrahman Salah',
            'email' => 'sabdelrahman110@gmail.com',
            'password' => Hash::make('12345678'), // Make sure to hash the password
        ]);
    }
}
