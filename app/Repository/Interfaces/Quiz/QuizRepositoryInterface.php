<?php

namespace App\Repository\Interfaces\Quiz;

interface QuizRepositoryInterface
{
	public function index();
	public function create();
	public function store($request);
	public function getStages($id);

	public function show($id);
	public function edit($id);
	public function update($request);
	public function destroy($request);
	public function result($id);
	public function restore($request);
}
