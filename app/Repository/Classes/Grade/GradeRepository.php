<?php

namespace App\Repository\Classes\Grade;

use App\DTO\GradeDTO;
use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Grade\GradeRepositoryInterface;

class GradeRepository implements GradeRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$stage = Stage::all();
		$grade = Grade::all();
		return view('Pages.Grade.index', compact('grade', 'translations'))->with(['stage' => $stage]);
	}

	public function store($request)
	{
		$grades = array_map(fn ($item) => new GradeDTO(
			$item['gradeEn'],
			$item['gradeAr'],
			$item['stageId']
		), $request->grades);

		try {
			$validated = $request->validated();
			foreach ($grades as $gradeDTO) {
				$grade = new Grade();
				$translations = ['en' => $gradeDTO->gradeEn, 'ar' => $gradeDTO->gradeAr];
				$grade->setTranslations('name', $translations);
				$grade->stage_id = $gradeDTO->stageId;
				$grade->save();
			}
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('grade.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('grade.index');
		}
	}

	public function update($request)
	{
		$validated = $request->validated();
		try {
			$gradeId = $request->gradeId;
			$grade = Grade::findOrFail($gradeId);
			$translations = ['en' => $request->gradeEn, 'ar' =>  $request->gradeAr];
			$grade->setTranslations('name', $translations);
			$grade->stage_id = $request->stageId;
			$grade->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('grade.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('grade.index');
		}
	}

	public function destroy($request)
	{

		$grade = Grade::findOrFail($request->gradeId);
		$grade->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('grade.index');
	}
	public function deleteAll($request)
	{
		$gradesId = explode(",", $request->gradesId);
		Grade::whereIn('id', $gradesId)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('grade.index');
	}
	public function filterGrade($request)
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		if ($request->stageId == 0) {
			return redirect()->route('grade.index');
		} else {
			$stage = Stage::all();
			$search = Grade::where('stage_id', $request->stageId)->get();
			return view('Pages.Grade.index', compact('stage', 'translations'))->withDetails($search);
		}
	}
}
