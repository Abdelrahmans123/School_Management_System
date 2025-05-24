<?php

namespace App\Repository\Interfaces\Student;

interface GraduatedStudentRepositoryInterface
{
	public function index();
	public function create();
	public function store($request);
	public function update($request);
	public function destroy($request);
}
