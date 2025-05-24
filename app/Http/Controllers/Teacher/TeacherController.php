<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Repository\Interfaces\Teacher\TeacherRepositoryInterface;


class TeacherController extends Controller
{
	protected $teacher;
	public function __construct(TeacherRepositoryInterface $teacherInterface)
	{
		$this->teacher = $teacherInterface;
	}
	public function index()
	{
		return $this->teacher->index();
	}
	public function dashboard()
	{
		return $this->teacher->dashboard();
	}
	public function students()
	{
		return $this->teacher->students();
	}
	public function create()
	{
		return $this->teacher->create();
	}

	public function store(StoreTeacherRequest $request)
	{

		return $this->teacher->store($request);
	}

	public function edit($id)
	{
		return $this->teacher->edit($id);
	}

	public function update(StoreTeacherRequest $request)
	{
		return $this->teacher->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->teacher->destroy($request);
	}
}
