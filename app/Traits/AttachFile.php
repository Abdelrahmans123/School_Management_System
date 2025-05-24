<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFile
{
	public function uploadFile($file, $folder)
	{
		$filename = $file->getClientOriginalName();
		$fullPath = $folder . '/' . $filename;

		// If file exists, delete it
		if (Storage::disk('uploads')->exists($fullPath)) {
			Storage::disk('uploads')->delete($fullPath);
		}

		// Store the file with the (possibly new) filename
		$path = $file->storeAs($folder, $filename, 'uploads');

		// Return the path where the file was stored
		return $path;
	}


	public function deleteFile($path)
	{
		if (Storage::disk('uploads')->exists($path)) {
			Storage::disk('uploads')->delete($path);
			return true;
		}
		return false;
	}
	public function deleteAllFiles($path)
	{
		// Delete all files in the folder
		$files = Storage::disk('uploads')->files($path);
		foreach ($files as $existingFile) {
			// Delete all files except the one being uploaded
			Storage::disk('uploads')->delete($existingFile);
		}
	}
}
