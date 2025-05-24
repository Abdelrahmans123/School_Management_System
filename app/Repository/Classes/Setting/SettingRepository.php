<?php

namespace App\Repository\Classes\Setting;



use App\Models\Setting;
use App\Traits\AttachFile;
use Illuminate\Support\Facades\Storage;
use App\Repository\Interfaces\Setting\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
	use AttachFile;
	public function index()
	{
		$collection = Setting::all();
		$setting = $collection->flatMap(function ($item) {
			return [$item['key'] => $item['value']];
		});
		return view('Pages.Setting.index', compact('setting'));
	}

	public function update($request)
	{
		try {
			$path = 'Attachments/logo';
			$information = $request->except('_token', '_method', 'site_logo');
			foreach ($information as $key => $value) {
				Setting::where('key', $key)->update(['value' => $value]);
			}
			if ($request->hasFile('site_logo')) {
				$file = $request->file('site_logo');
				$fileName = $file->getClientOriginalName();
				$this->deleteAllFiles($path);
				$this->uploadFile($file, $path);
				Setting::where('key', 'site_logo')->update(['value' => $fileName]);
			}
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('settings.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('settings.index');
		}
	}
}
