<?php

namespace App\Repository\Classes\Subject;

use App\Models\Grade;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Subject\SubjectRepositoryInterface;


class SubjectRepository implements SubjectRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$subjects = Subject::all();
		$stages = Stage::all();
		$grades = Grade::all();
		$teachers = Teacher::all();
		$url = URL::to(App::getLocale() . '/admin/getGrade');
		$teacherUrl = URL::to(App::getLocale() . '/admin/getSpecialization');
		return view('Pages.Subject.index', compact('subjects', 'translations', 'stages', 'grades', 'teachers', 'url', 'teacherUrl'));
	}
	public function getSpecialization($id)
	{
		$teacher = Teacher::where('id', $id)->first();
		$specialization = Specialization::where('id', $teacher->specialization_id)->get();
		return response()->json($specialization);
	}


	public function store($request)
	{
		try {
			$validated = $request->validated();
			$subject = new Subject();
			$translations = ['en' => $request->subjectEn, 'ar' => $request->subjectAr];
			$subject->name = $translations;
			$subject->stage_id = $request->stageId;
			$subject->grade_id = $request->gradeId;
			$subject->teacher_id = $request->teacherId;
			$subject->save();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('subject.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('subject.index');
		}
	}
	public function update($request)
	{
		try {
			$id = $request->id;
			$validated = $request->validated();
			$subject = Subject::findOrFail($id);
			$translations = ['en' => $request->subjectEn, 'ar' => $request->subjectAr];
			$subject->name = $translations;
			$subject->stage_id = $request->stageId;
			$subject->grade_id = $request->gradeId;
			$subject->teacher_id = $request->teacherId;
			$subject->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('subject.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('subject.index');
		}
	}
	public function destroy($request)
	{
		try {
			$id = $request->id;
			$subject = Subject::findOrFail($id);
			$subject->delete();
			flash()->addSuccess(trans('message.dataDeleted'));
			return redirect()->route('subject.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('subject.index');
		}
	}
}
