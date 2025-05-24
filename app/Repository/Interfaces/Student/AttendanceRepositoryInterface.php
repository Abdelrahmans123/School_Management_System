<?php

namespace App\Repository\Interfaces\Student;

interface AttendanceRepositoryInterface
{
	public function index();
	public function create();
	public function show($attendance);
	public function store($request);
	public function update($request, $attendance);
	public function destroy($request);
	public function report();
	public function search($request);
}
