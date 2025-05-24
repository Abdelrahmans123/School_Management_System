<?php
namespace App\Repository\Interfaces\Exam;



interface ExamRepositoryInterface
{
	public function index();
	public function store($request);
	public function update($request);
	public function destroy($request);
}
