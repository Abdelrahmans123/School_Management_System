<?php

namespace App\Repository\Interfaces\Student;

interface StudentRepositoryInterface
{
	public function index();
	public function dashboard();
	public function create();
	public function store($request);
	public function edit($id);
	public function show($id);
	public function update($request);
	public function destroy($request);
	public function uploadAttachment($request);
	public function downloadAttachment($studentName, $fileName);
	public function deleteAttachment($request);
}
