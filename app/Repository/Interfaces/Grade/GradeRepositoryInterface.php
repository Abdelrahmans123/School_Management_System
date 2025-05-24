<?php

namespace App\Repository\Interfaces\Grade;

interface GradeRepositoryInterface
{
	public function index();
	public function store($request);
	public function filterGrade($request);
	public function deleteAll($request);
	public function update($request);
	public function destroy($request);
}
