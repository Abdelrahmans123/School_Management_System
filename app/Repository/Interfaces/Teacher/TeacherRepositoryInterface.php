<?php

namespace App\Repository\Interfaces\Teacher;



interface TeacherRepositoryInterface
{
	public function index();
	public function dashboard();
	public function students();
	public function getAll();
	public function create();
	public function store($request);
	public function edit($id);
	public function update($request);
	public function destroy($request);
}
