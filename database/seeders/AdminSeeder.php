<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        Admin::create([
            'name' => json_encode([
                'en' => 'Abdelrahman Salah',
                'ar' => 'عبدالرحمن صلاح',
            ]),
            'email' => 'sabdelrahman110@gmail.com',
            'password' => Hash::make('12345678'), // Make sure to hash the password
        ]);
    }
}
