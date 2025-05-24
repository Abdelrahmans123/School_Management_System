<?php

namespace App\Http\Controllers\Grade;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Repository\Interfaces\Grade\GradeRepositoryInterface;


class GradeController extends Controller
{
	protected $grade;
	public function __construct(GradeRepositoryInterface $gradeRepositoryInterface)
	{
		$this->grade = $gradeRepositoryInterface;
	}
	public function index()
	{
		return $this->grade->index();
	}

	public function store(StoreGradeRequest $request)
	{
		return $this->grade->store($request);
	}

	public function update(StoreGradeRequest $request)
	{
		return $this->grade->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->grade->destroy($request);
	}
	public function deleteAll(Request $request)
	{
		return $this->grade->deleteAll($request);
	}
	public function filterGrade(Request $request)
	{
		return $this->grade->filterGrade($request);
	}
}
