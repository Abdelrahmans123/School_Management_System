<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Stage;

class GradeSeeder extends Seeder
{
	public function run()
	{
		$primaryStage = Stage::where('Name->en', 'Primary Stage')->first();
		$preparatoryStage = Stage::where('Name->en', 'Preparatory Stage')->first();
		$secondaryStage = Stage::where('Name->en', 'Secondary Stage')->first();

		$grades = [
			['name' => ['en' => 'First Grade', 'ar' => 'الصف الأول'], 'stage_id' => $primaryStage->id],
			['name' => ['en' => 'Second Grade', 'ar' => 'الصف الثاني'], 'stage_id' => $primaryStage->id],
			['name' => ['en' => 'Third Grade', 'ar' => 'الصف الثالث'], 'stage_id' => $primaryStage->id],
			['name' => ['en' => 'Fourth Grade', 'ar' => 'الصف الرابع'], 'stage_id' => $primaryStage->id],
			['name' => ['en' => 'Fifth Grade', 'ar' => 'الصف الخامس'], 'stage_id' => $primaryStage->id],
			['name' => ['en' => 'Sixth Grade', 'ar' => 'الصف السادس'], 'stage_id' => $primaryStage->id],
			['name' => ['en' => 'First Grade', 'ar' => 'الصف الأول'], 'stage_id' => $preparatoryStage->id],
			['name' => ['en' => 'Second Grade', 'ar' => 'الصف الثاني'], 'stage_id' => $preparatoryStage->id],
			['name' => ['en' => 'Third Grade', 'ar' => 'الصف الثالث'], 'stage_id' => $preparatoryStage->id],
			['name' => ['en' => 'First Grade', 'ar' => 'الصف الأول'], 'stage_id' => $secondaryStage->id],
			['name' => ['en' => 'Second Grade', 'ar' => 'الصف الثاني'], 'stage_id' => $secondaryStage->id],
			['name' => ['en' => 'Third Grade', 'ar' => 'الصف الثالث'], 'stage_id' => $secondaryStage->id],
		];

		foreach ($grades as $grade) {
			Grade::create($grade);
		}
	}
}
