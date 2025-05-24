<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            [
                'en' => 'Computer Science',
                'ar' => 'علوم الحاسوب',
            
            ],
            [
                'en' => 'Mathematics',
                'ar' => 'الرياضيات',
            
            ],
            [
                'en' => 'Physics',
                'ar' => 'الفيزياء',

            ],
            [
                'en' => 'Geography',
                'ar' => 'الجغرافيا',

            ],
            [
                'en' => 'Chemistry',
                'ar' => 'الكيمياء',

            ],
            [
                'en' => 'Biology',
                'ar' => 'علم الأحياء',
            
            ],
            [
                'en' => 'History',
                'ar' => 'التاريخ',
                
            ],
            [
                'en' => 'Arabic Language',
                'ar' => 'اللغه العربيه',
                
            ],
            [
                'en' => 'English Language',
                'ar' => 'اللغه الانجليزيه',
                
            ],
            // Add more specializations in both languages as needed
        ];
        DB::table('specializations')->delete();
        foreach ($specializations as $specialization) {
            Specialization::create(['name' => $specialization]);
        }
    }
}
