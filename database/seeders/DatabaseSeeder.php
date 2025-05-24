<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();
		$this->call(AdminSeeder::class);
		$this->call(BloodTypesSeeder::class);
		$this->call(NationalitySeeder::class);
		$this->call(ReligionSeeder::class);
		$this->call(GenderSeeder::class);
		$this->call(SpecializationSeeder::class);
		$this->call(StageSeeder::class);
		$this->call(GradeSeeder::class);
		$this->call(TeacherSeeder::class);
		$this->call(SectionSeeder::class);
		$this->call(ParentSeeder::class);
		$this->call(StudentSeeder::class);
		$this->call(SettingSeeder::class);
	}
}
