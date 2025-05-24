<?php

namespace App\Repository\Classes\Quiz;

use App\Models\Degree;
use App\Models\Exam;
use App\Models\Quiz;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Quiz\QuizRepositoryInterface;



class QuizRepository implements QuizRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$quizzes = Quiz::where('teacher_id', auth()->user()->id)->get();
		return view('Pages.Quiz.index', compact('quizzes', 'translations'));
	}
	public function create()
	{
		$stages = Stage::all();
		$subjects = Subject::where('teacher_id', auth()->user()->id)->get();
		$exams = Exam::all();
		$url = URL::to(App::getLocale() . '/teacher/getGrade');
		$stageUrl = URL::to(App::getLocale() . '/teacher/getStages');
		$sectionUrl = URL::to(App::getLocale() . '/teacher/getSection');
		return view('Pages.Quiz.create', compact('stages', 'subjects', 'url', 'sectionUrl', 'exams', 'stageUrl'));
	}
	public function store($request)
	{

		try {
			$validated = $request->validated();
			$quiz = new Quiz();
			$translations = ['en' => $request->name_en, 'ar' =>  $request->name_ar];
			$quiz->setTranslations('name', $translations);
			$quiz->stage_id = $request->stage_id;
			$quiz->subject_id = $request->subject_id;
			$quiz->teacher_id = auth()->user()->id;
			$quiz->grade_id = $request->grade_id;
			$quiz->section_id = $request->section_id;
			$quiz->exam_id = $request->exam_id;
			$quiz->save();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('teacher.quiz.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('teacher.quiz.index');
		}
	}
	public function show($id)
	{
		$exam_id = $id;
		$stages = Stage::all();
		$teachers = Teacher::all();
		$subjects = Subject::all();
		$url = URL::to(App::getLocale() . '/teacher/getGrade');
		$sectionUrl = URL::to(App::getLocale() . '/teacher/getSection');
		$stageUrl = URL::to(App::getLocale() . '/teacher/getStages');
		return view('Pages.Quiz.create', compact('stages', 'teachers', 'subjects', 'exam_id', 'url', 'sectionUrl', 'stageUrl'));
	}
	public function edit($id)
	{
		$quiz = Quiz::findOrFail($id);
		$stages = Stage::all();
		$teachers = Teacher::all();
		$subjects = Subject::all();
		$url = URL::to(App::getLocale() . '/teacher/getGrade');
		$stageUrl = URL::to(App::getLocale() . '/teacher/getStages');
		$sectionUrl = URL::to(App::getLocale() . '/teacher/getSection');
		return view('Pages.Quiz.edit', compact('stages', 'teachers', 'subjects', 'quiz', 'url', 'sectionUrl', 'stageUrl'));
	}
	public function update($request)
	{
		try {
			$validated = $request->validated();
			$quiz = Quiz::findOrFail($request->id);
			$translations = ['en' => $request->name_en, 'ar' =>  $request->name_ar];
			$quiz->setTranslations('name', $translations);
			$quiz->stage_id = $request->stage_id;
			$quiz->subject_id = $request->subject_id;
			$quiz->teacher_id = auth()->user()->id;
			$quiz->grade_id = $request->grade_id;
			$quiz->section_id = $request->section_id;
			$quiz->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('teacher.quiz.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('teacher.quiz.index');
		}
	}
	public function destroy($request)
	{
		$quiz = Quiz::findOrFail($request->id)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('teacher.quiz.index');
	}
	public function getStages($id)
	{
		$stages = Stage::whereHas('section.teachers', function ($query) use ($id) {
			$query->where('teacher_id', $id);
		})
			->with(['section' => function ($query) use ($id) {
				$query->whereHas('teachers', function ($q) use ($id) {
					$q->where('teacher_id', $id);
				});
			}])
			->get();

		return response()->json($stages);
	}
	public function result($id)
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$degrees = Degree::where('quiz_id', $id)->get();
		return view('Pages.Quiz.Result.index', compact('degrees', 'translations'));
	}
	public function restore($request)
	{
		try {
			Degree::where('student_id', $request->student_id)->where('quiz_id', $request->quiz_id)->delete();
			flash()->addSuccess(trans('message.dataDeleted'));
			return redirect()->route('teacher.quiz.result', $request->quiz_id);
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('teacher.quiz.result', $request->quiz_id);
		}
	}
}
