<?php

namespace App\Repository\Interfaces\Parent;

interface ParentRepositoryInterface
{
	public function index();
	public function dashboard();
	public function create();
	public function students();
	public function studentResults($student_id);
	public function studentAttendance();
	public function search($request);
	public function studentFee();
	public function receipt($id);
}
