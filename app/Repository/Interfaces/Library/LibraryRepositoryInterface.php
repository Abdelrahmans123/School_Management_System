<?php

namespace App\Repository\Interfaces\Library;

interface LibraryRepositoryInterface
{
	public function index();
	public function create();
	public function store($request);
	public function show($id);
	public function edit($id);
	public function update($request);
	public function destroy($request);
	public function download($fileName);
}
