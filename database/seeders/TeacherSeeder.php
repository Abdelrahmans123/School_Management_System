<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$computerScienceId = $this->getSpecializationId('Computer Science');
		$maleGenderId = $this->getGenderId('Male');

		$teachers = [
			[
				'name' => [
					'en' => 'Ahmed Khaled',
					'ar' => 'احمد خالد'
				],
				'email' => 'ahmed123@gmail.com',
				'password' => Hash::make('12345678'),
				'joiningDate' => '2017-01-01',
				'address' => 'Almukkattam',
				'specialization_id' => $computerScienceId,
				'gender_id' => $maleGenderId,
			],
			// Add more teachers as needed
		];
// Clear existing data

		foreach ($teachers as $teacherData) {
			$this->createTeacher($teacherData);
		}
	}

	/**
	 * Get the ID of a specialization by its name.
	 *
	 * @param string $name
	 * @return int
	 */
	private function getSpecializationId(string $name): int
	{
		return Specialization::where('name->en', $name)->firstOrFail()->id;
	}

	/**
	 * Get the ID of a gender by its name.
	 *
	 * @param string $name
	 * @return int
	 */
	private function getGenderId(string $name): int
	{
		return Gender::where('name->en', $name)->firstOrFail()->id;
	}

	/**
	 * Create a teacher with the given data.
	 *
	 * @param array $teacherData
	 * @return void
	 */
	private function createTeacher(array $teacherData): void
	{
		$teacher = new Teacher();
		$teacher->setTranslations('name', $teacherData['name']);
		$teacher->email = $teacherData['email'];
		$teacher->password = $teacherData['password'];
		$teacher->joiningDate = $teacherData['joiningDate'];
		$teacher->address = $teacherData['address'];
		$teacher->specialization_id = $teacherData['specialization_id'];
		$teacher->gender_id = $teacherData['gender_id'];
		$teacher->save();
	}
}
