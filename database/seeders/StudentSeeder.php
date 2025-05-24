<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Stage;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Guardian;
use App\Models\BloodType;
use App\Models\Nationality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$male = Gender::where('name->en', 'Male')->firstOrFail()->id;
		$egyptian = Nationality::where('name->en', 'Egyptian')->firstOrFail()->id;
		$bloodType = BloodType::where('type', 'A+')->firstOrFail()->id;
		$primaryStage = Stage::where('name->en', 'Primary Stage')->firstOrFail()->id;
		$firstGradePrimaryStage = Grade::where('name->en', 'First Grade')->where('stage_id', $primaryStage)->firstOrFail()->id;
		$firstGradePrimaryStageSection = Section::where('name->en', 'A')->where('stage_id', $primaryStage)->where('grade_id', $firstGradePrimaryStage)->firstOrFail()->id;
		$parent = Guardian::where('fatherName->en', 'Osama')->firstOrFail()->id;

		$students = [
			[
				'name' => json_encode([
					'en' => 'Ali',
					'ar' => 'على',
				]),
				'email' => 'ali123@gmail.com',
				'password' => Hash::make('12345678'),
				'birthDate' => '2017-01-01',
				'academicYear' => '2023',
				'gender_id' => $male,
				'nationality_id' => $egyptian,
				'bloodType_id' => $bloodType,
				'stage_id' => $primaryStage,
				'grade_id' => $firstGradePrimaryStage,
				'section_id' => $firstGradePrimaryStageSection,
				'parent_id' => $parent,
			],

			// Add more students as needed
		];

		DB::table('students')->delete(); // Optional if you want to clear existing data

		foreach ($students as $student) {
			DB::table('students')->insert($student);
		}
	}
}
