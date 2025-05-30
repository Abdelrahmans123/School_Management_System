<?php

namespace App\Repository\Interfaces\Fee;

interface ProcessingFeeRepositoryInterface
{
	public function index();
	public function create();
	public function store($request);
	public function show($id);
	public function edit($id);
	public function update($request);
	public function destroy($request);
}
