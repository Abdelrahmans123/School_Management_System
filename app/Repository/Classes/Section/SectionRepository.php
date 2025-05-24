<?php

namespace App\Repository\Classes\Section;

use App\Models\Grade;
use App\Models\Stage;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Section\SectionRepositoryInterface;


class SectionRepository implements SectionRepositoryInterface
{
	public function index()
	{
		$url = URL::to(App::getLocale() . '/getGrade');
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$sections = Stage::with(['section'])->get();
		$teachers = Teacher::all();
		$stages = Stage::all();
		$sectionTeacher = Teacher::with('sections')->get();
		return view('Pages.Section.index', compact('sections', 'translations', 'sectionTeacher'))->with(['stages' => $stages, 'url' => $url, 'teachers' => $teachers]);
	}
	public function store($request)
	{
		try {
			$validated = $request->validated();
			$section = new Section();
			$translations = ['en' => $request->sectionEn, 'ar' => $request->sectionAr];
			$section->setTranslations('name', $translations);
			$section->status = 1;
			$section->grade_id = $request->gradeId;
			$section->stage_id = $request->stageId;
			$section->save();
			$section->teachers()->attach($request->teachersId);
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('section.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('section.index');
		}
	}


	public function getGrade($id)
	{
		$grades = Grade::where('stage_id', $id)->get();
		return response()->json($grades);
	}
	public function getSection($id)
	{
		$sections = Section::where('grade_id', $id)->get();
		return response()->json($sections);
	}
	public function update($request)
	{
		$id = $request->sectionId;
		try {
			$validated = $request->validated();
			$section = Section::findOrFail($id);
			$translations = ['en' => $request->sectionEn, 'ar' => $request->sectionAr];
			$section->setTranslations('name', $translations);
			if (isset($request->status)) {
				$section->status = 1;
			} else {
				$section->status = 0;
			}
			$section->grade_id = $request->gradeId;
			$section->stage_id = $request->stageId;
			if (isset($request->teachersId)) {
				$section->teachers()->sync($request->teachersId);
			} else {
				$section->teachers()->sync(array());
			}
			$section->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('section.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('section.index');
		}
	}

	public function destroy($request)
	{
		Section::findOrFail($request->sectionId)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('section.index');
	}
}
