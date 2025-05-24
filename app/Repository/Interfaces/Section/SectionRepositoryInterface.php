<?php

namespace App\Repository\Interfaces\Section;

interface SectionRepositoryInterface
{
	public function index();
	public function store($request);
	public function getGrade($id);
	public function getSection($id);
	public function update($request);
	public function destroy($request);
}
