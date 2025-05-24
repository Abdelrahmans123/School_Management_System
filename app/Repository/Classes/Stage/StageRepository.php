<?php

namespace App\Repository\Classes\Stage;

use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Stage\StageRepositoryInterface;

class StageRepository implements StageRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$stage = Stage::all();
		return view('Pages.Stage.index', compact('stage', 'translations'));
	}
	public function store($request)
	{
		try {
			$validated = $request->validated();
			$stage = new Stage();
			$translations = ['en' => $request->stageEn, 'ar' => $request->stageAr];
			$stage->setTranslations('Name', $translations);
			$stage->Notes = $request->note;
			$stage->save();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('stage.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('stage.index');
		}
	}
	public function update($request)
	{
		try {
			$validated = $request->validated();
			$grade = Stage::findOrFail($request->stageId);
			$translations = ['en' => $request->stageEn, 'ar' => $request->stageAr];
			$grade->setTranslations('Name', $translations);
			$grade->Notes = $request->note;
			$grade->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('stage.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('stage.index');
		}
	}
	public function destroy($request)
	{
		$grades = Grade::where('stage_id', $request->stageId)->pluck('stage_id');
		if ($grades->count() == 0) {
			$stage = Stage::findOrFail($request->stageId);
			$stage->delete();
			flash()->addSuccess(trans('message.dataDeleted'));
			return redirect()->route('stage.index');
		} else {
			flash()->addError(trans('stage.haveGrade'));
			return redirect()->route('stage.index');
		}
	}
}
