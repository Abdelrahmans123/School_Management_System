<?php

namespace App\Repository\Interfaces\Subject;



interface SubjectRepositoryInterface
{
	public function index();
	public function getSpecialization($id);
	public function store($request);
	public function update($request);
	public function destroy($request);
}
