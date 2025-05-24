<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stage;

class StageSeeder extends Seeder
{
	public function run()
	{
		$stages = [
			['name' => ['en' => 'Primary Stage', 'ar' => 'المرحلة الابتدائية']],
			['name' => ['en' => 'Preparatory Stage', 'ar' => 'المرحلة الإعدادية']],
			['name' => ['en' => 'Secondary Stage', 'ar' => 'المرحلة الثانوية']],
		];

		foreach ($stages as $stage) {
			Stage::create($stage);
		}
	}
}
