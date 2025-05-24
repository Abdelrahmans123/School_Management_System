<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('settings')->delete();
		$data = [
			['key' => 'site_name', 'value' => 'Laravel'],
			['key' => 'site_email', 'value' => 'info@laravel.com'],
			['key' => 'site_phone', 'value' => '0123456789'],
			['key' => 'site_address', 'value' => 'Cairo, Egypt'],
			['key' => 'site_status', 'value' => '1'],
			['key' => 'site_logo', 'value' => 'logo.png'],
			['key' => 'site_icon', 'value' => 'icon.png'],
			['key' => 'site_description', 'value' => 'Laravel'],
			['key' => 'site_keywords', 'value' => 'Laravel'],
			['key' => 'site_facebook', 'value' => 'https://www.facebook.com/'],
			['key' => 'site_twitter', 'value' => 'https://www.twitter.com/'],
			['key' => 'site_instagram', 'value' => 'https://www.instagram.com/'],
			['key' => 'site_linkedin', 'value' => 'https://www.linkedin.com/'],
			['key' => 'site_youtube', 'value' => 'https://www.youtube.com/'],
			['key' => 'first_term_end', 'value' => '12-12-2022'],
			['key' => 'second_term_end', 'value' => '1-12-2023'],
			['key' => 'academic_year', 'value' => '2022-2023'],
		];
		DB::table('settings')->insert($data);
	}
}
