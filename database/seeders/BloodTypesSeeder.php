<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTypesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Define blood types and seed the table
		$bloodTypes = [
			'A+',
			'A-',
			'B+',
			'B-',
			'AB+',
			'AB-',
			'O+',
			'O-',
			// Add more blood types if needed
		];
		DB::table('blood_types')->delete();
		foreach ($bloodTypes as $type) {
			BloodType::create(['type' => $type]);
		}
	}
}
