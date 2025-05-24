<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Student\GraduatedStudentRepositoryInterface;


class GraduatedStudentController extends Controller
{
	protected $graduatedStudentRepository;
	public function __construct(GraduatedStudentRepositoryInterface $graduatedStudentRepositoryInterface)
	{
		$this->graduatedStudentRepository = $graduatedStudentRepositoryInterface;
	}
	public function index()
	{
		return $this->graduatedStudentRepository->index();
	}

	public function create()
	{
		return $this->graduatedStudentRepository->create();
	}

	public function store(Request $request)
	{
		return $this->graduatedStudentRepository->store($request);
	}

	public function update(Request $request){
		return $this->graduatedStudentRepository->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->graduatedStudentRepository->destroy($request);
	}
}
