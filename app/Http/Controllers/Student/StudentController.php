<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Repository\Interfaces\Student\StudentRepositoryInterface;


class StudentController extends Controller
{
	protected $student;
	public function __construct(StudentRepositoryInterface $studentInterface)
	{
		$this->student = $studentInterface;
	}
	public function index()
	{
		return $this->student->index();
	}
	public function dashboard()
	{
		return $this->student->dashboard();
	}
	public function create()
	{
		return $this->student->create();
	}

	public function store(StoreStudentRequest $request)
	{
		return $this->student->store($request);
	}

	public function show($id)
	{
		return $this->student->show($id);
	}

	public function edit($id)
	{
		return $this->student->edit($id);
	}

	public function update(StoreStudentRequest $request)
	{
		return $this->student->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->student->destroy($request);
	}

	public function uploadAttachment(Request $request)
	{
		return $this->student->uploadAttachment($request);
	}

	public function downloadAttachment($studentName, $fileName)
	{
		return $this->student->downloadAttachment($studentName, $fileName);
	}

	public function deleteAttachment(Request $request)
	{
		return $this->student->deleteAttachment($request);
	}
}
