<?php

namespace App\Repository\Interfaces\Question;

interface QuestionRepositoryInterface
{
	public function index();
	public function create($id);
	public function store($request);
	public function edit($id);
	public function show($id);
	public function update($request);

	public function destroy($request);
}
