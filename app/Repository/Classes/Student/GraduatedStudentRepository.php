<?php

namespace App\Repository\Classes\Student;

use App\Models\Stage;
use App\Models\Student;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Student\GraduatedStudentRepositoryInterface;

class GraduatedStudentRepository implements GraduatedStudentRepositoryInterface
{
	public function index()
	{
		$students = Student::onlyTrashed()->get();
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Student.Graduated.index', compact('students', 'translations'));
	}
	public function create()
	{
		$data['stages'] = Stage::all();
		$url = URL::to(App::getLocale() . '/getGrade');
		$sectionUrl = URL::to(App::getLocale() . '/getSection');
		return view('Pages.Student.Graduated.create', compact('data', 'sectionUrl', 'url'));
	}
	public function store($request)
	{
		$students = Student::where('stage_id', $request->stageId)->where('grade_id', $request->gradeId)->where('section_id', $request->sectionId)->get();
		if ($students->count() < 1) {
			flash()->addError(trans('message.noStudents'));
			return redirect()->route('graduated.create');
		}
		foreach ($students as $student) {
			$ids = explode(',', $student->id);
			Student::whereIn('id', $ids)->delete();
		}
		flash()->addSuccess(trans('message.dataSaved'));
		return redirect()->route('graduated.index');
	}
	public function update($request)
	{
		Student::onlyTrashed()->where('id', $request->id)->first()->restore();
		flash()->addSuccess(trans('message.success'));
		return redirect()->route('graduated.index');
	}
	public function destroy($request)
	{
		Student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('graduated.index');
	}
}
