<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religions = [
            ['en' => 'Islam', 'ar' => 'الإسلام'],
            ['en' => 'Christianity', 'ar' => 'المسيحية'],
            // Add more bilingual data as needed
        ];
        DB::table('religions')->delete();
        foreach ($religions as $religion) {
            Religion::create(['name' => $religion]);
        }
    }
}
