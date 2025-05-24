<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Section;
use App\Models\SectionTeacher;
use App\Models\Stage;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$stages = [
			'primary' => Stage::where('name->en', 'Primary Stage')->firstOrFail()->id,
			'preparatory' => Stage::where('name->en', 'Preparatory Stage')->firstOrFail()->id,
			'secondary' => Stage::where('name->en', 'Secondary Stage')->firstOrFail()->id,
		];

		$grades = [
			'primary' => [
				'First Grade' => Grade::where('name->en', 'First Grade')->where('stage_id', $stages['primary'])->firstOrFail()->id,
				'Second Grade' => Grade::where('name->en', 'Second Grade')->where('stage_id', $stages['primary'])->firstOrFail()->id,
				'Third Grade' => Grade::where('name->en', 'Third Grade')->where('stage_id', $stages['primary'])->firstOrFail()->id,
				'Fourth Grade' => Grade::where('name->en', 'Fourth Grade')->where('stage_id', $stages['primary'])->firstOrFail()->id,
				'Fifth Grade' => Grade::where('name->en', 'Fifth Grade')->where('stage_id', $stages['primary'])->firstOrFail()->id,
				'Sixth Grade' => Grade::where('name->en', 'Sixth Grade')->where('stage_id', $stages['primary'])->firstOrFail()->id,
			],
			'preparatory' => [
				'First Grade' => Grade::where('name->en', 'First Grade')->where('stage_id', $stages['preparatory'])->firstOrFail()->id,
				'Second Grade' => Grade::where('name->en', 'Second Grade')->where('stage_id', $stages['preparatory'])->firstOrFail()->id,
				'Third Grade' => Grade::where('name->en', 'Third Grade')->where('stage_id', $stages['preparatory'])->firstOrFail()->id,
			],
			'secondary' => [
				'First Grade' => Grade::where('name->en', 'First Grade')->where('stage_id', $stages['secondary'])->firstOrFail()->id,
				'Second Grade' => Grade::where('name->en', 'Second Grade')->where('stage_id', $stages['secondary'])->firstOrFail()->id,
				'Third Grade' => Grade::where('name->en', 'Third Grade')->where('stage_id', $stages['secondary'])->firstOrFail()->id,
			],
		];

		$teacherId = Teacher::firstOrFail()->id;

		$sectionNames = [
			['en' => 'A', 'ar' => 'أ'],
			['en' => 'B', 'ar' => 'ب'],
			['en' => 'C', 'ar' => 'ج'],
			['en' => 'D', 'ar' => 'د']
		];

		$sections = [];

		foreach (['primary', 'preparatory', 'secondary'] as $stageKey) {
			foreach ($grades[$stageKey] as $gradeId) {
				foreach ($sectionNames as $sectionName) {
					$sections[] = [
						'name' => $sectionName,
						'stage_id' => $stages[$stageKey],
						'grade_id' => $gradeId,
						'status' => 1,
						'teacher_id' => $teacherId,
					];
				}
			}
		}

		DB::table('sections')->delete(); // Optional if you want to clear existing data
		DB::table('section_teachers')->delete(); // Optional if you want to clear existing data

		foreach ($sections as $item) {
			Section::create([
				'name' => $item['name'], // Provide a default name to avoid SQL error
				'stage_id' => $item['stage_id'],
				'grade_id' => $item['grade_id'],
				'status' => $item['status'],
			]);
		}
		SectionTeacher::create([
			'teacher_id' => $item['teacher_id'],
			'section_id' => 1,
		]);
	}
}
