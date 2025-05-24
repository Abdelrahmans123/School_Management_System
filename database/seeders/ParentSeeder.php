<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$egyptianNationalityId = $this->getNationalityId('Egyptian');
		$bloodTypeId = $this->getBloodTypeId('A+');
		$religionId = $this->getReligionId('Islam');

		$guardians = [
			[
				'email' => 'ali123@gmail.com',
				'password' => Hash::make('12345678'),
				'fatherName' => $this->encodeName('Osama', 'اسامه'),
				'fatherIdNumber' => '1234567890',
				'fatherPassportNumber' => '1234567890',
				'fatherPhone' => '1234567890',
				'fatherJob' => $this->encodeJob('Engineering', 'مهندس'),
				'fatherNationalityId' => $egyptianNationalityId,
				'fatherBloodTypeId' => $bloodTypeId,
				'fatherReligionId' => $religionId,
				'fatherAddress' => 'Almukkattam',
				'motherName' => $this->encodeName('Fatma', 'فاطمة'),
				'motherIdNumber' => '0987654321',
				'motherPassportNumber' => '0987654321',
				'motherPhone' => '0987654321',
				'motherJob' => $this->encodeJob('Doctor', 'دكتور'),
				'motherNationalityId' => $egyptianNationalityId,
				'motherBloodTypeId' => $bloodTypeId,
				'motherReligionId' => $religionId,
				'motherAddress' => 'Almukkattam',
			],
		];

		DB::table('guardians')->delete();
		DB::table('guardians')->insert($guardians);
	}

	/**
	 * Get the ID of a nationality by its name.
	 *
	 * @param string $name
	 * @return int
	 */
	private function getNationalityId(string $name): int
	{
		return Nationality::where('name->en', $name)->firstOrFail()->id;
	}

	/**
	 * Get the ID of a blood type by its type.
	 *
	 * @param string $type
	 * @return int
	 */
	private function getBloodTypeId(string $type): int
	{
		return BloodType::where('type', $type)->firstOrFail()->id;
	}

	/**
	 * Get the ID of a religion by its name.
	 *
	 * @param string $name
	 * @return int
	 */
	private function getReligionId(string $name): int
	{
		return Religion::where('name->en', $name)->firstOrFail()->id;
	}

	/**
	 * Encode a name into JSON format.
	 *
	 * @param string $enName
	 * @param string $arName
	 * @return string
	 */
	private function encodeName(string $enName, string $arName): string
	{
		return json_encode(['en' => $enName, 'ar' => $arName]);
	}

	/**
	 * Encode a job into JSON format.
	 *
	 * @param string $enJob
	 * @param string $arJob
	 * @return string
	 */
	private function encodeJob(string $enJob, string $arJob): string
	{
		return json_encode(['en' => $enJob, 'ar' => $arJob]);
	}
}
