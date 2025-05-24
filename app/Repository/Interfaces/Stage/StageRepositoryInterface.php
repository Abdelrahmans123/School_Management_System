<?php

namespace App\Repository\Interfaces\Stage;

interface StageRepositoryInterface
{
	public function index();
	public function store($request);
	public function update($request);
	public function destroy($request);
}
