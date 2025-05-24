<?php

namespace App\Repository\Classes\Teacher\Student;

use App\Models\Student;
use App\Models\Teacher;
use App\Repository\Interfaces\Teacher\Student\StudentRepositoryInterface;
use Illuminate\Support\Facades\Lang;

class StudentRepository implements StudentRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$sectionIds = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
		$students = Student::whereIn('section_id', $sectionIds)->get();
		return view('Pages.Student.Attendance.index', compact('students', 'translations'));
	}
	public function create()
	{
		return view('Pages.Teacher.Student.create');
	}
	public function store($request) {}
	public function edit($id) {}
	public function update($request) {}
	public function destroy($id) {}
}
