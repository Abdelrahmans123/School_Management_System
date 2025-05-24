<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Setting\SettingRepositoryInterface;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
	protected $settings;
	public function __construct(SettingRepositoryInterface $settingRepositoryInterface)
	{
		$this->settings = $settingRepositoryInterface;
	}
	public function index()
	{
		return $this->settings->index();
	}
	public function update(Request $request)
	{
		return $this->settings->update($request);
	}
}
