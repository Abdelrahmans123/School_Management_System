<?php

namespace App\Repository\Classes\Teacher;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Teacher\TeacherRepositoryInterface;


class TeacherRepository implements TeacherRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$teachers = $this->getAll();
		return view('Pages.Teacher.index', compact('teachers', 'translations'));
	}
	public function dashboard()
	{
		$sectionIds = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
		$sectionCount = $sectionIds->count();
		$studentCount = Student::whereIn('section_id', $sectionIds)->count();
		return view('Pages.Teacher.Dashboard.dashboard', compact('sectionCount', 'studentCount'));
	}
	public function students()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$sectionIds = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
		$students = Student::whereIn('section_id', $sectionIds)->get();
		return view('Pages.Teacher.Student.index', compact('students', 'translations'));
	}
	public function getAll()
	{
		return Teacher::all();
	}

	public function create()
	{
		$gender = Gender::all();
		$specialize = Specialization::all();
		return view('Pages.Teacher.create', compact('gender', 'specialize'));
	}
	public function store($request)
	{
		try {
			$validated = $request->validated();
			$teacher = new Teacher();
			$teacher->email = $request->email;
			$teacher->password = Hash::make($request->password);
			$translations = ['en' => $request->nameEn, 'ar' => $request->nameAr];
			$teacher->setTranslations('name', $translations);
			$teacher->joiningDate = $request->joinDate;
			$teacher->address = $request->address;
			$teacher->specialization_id = $request->specializeId;
			$teacher->gender_id = $request->genderId;
			$teacher->save();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('teacher.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('teacher.index');
		}
	}
	public function edit($id)
	{
		$gender = Gender::all();
		$specialize = Specialization::all();
		$teacher = Teacher::findOrFail($id);
		return view('Pages.Teacher.edit', compact('gender', 'specialize', 'teacher'));
	}
	public function update($request)
	{
		try {
			$validated = $request->validated();
			$teacher = Teacher::findOrFail($request->teacherId);
			$teacher->email = $request->email;
			$teacher->password = Hash::make($request->password);
			$translations = ['en' => $request->nameEn, 'ar' => $request->nameAr];
			$teacher->setTranslations('name', $translations);
			$teacher->joiningDate = $request->joinDate;
			$teacher->address = $request->address;
			$teacher->specialization_id = $request->specializeId;
			$teacher->gender_id = $request->genderId;
			$teacher->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('teacher.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('teacher.index');
		}
	}
	public function destroy($request)
	{
		$teacher = Teacher::findOrFail($request->teacherId)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('teacher.index');
	}
}
