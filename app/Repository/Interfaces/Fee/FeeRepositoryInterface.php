<?php

namespace App\Repository\Interfaces\Fee;

interface FeeRepositoryInterface
{
	public function index();
	public function store($request);
	public function update($request);
	public function getFee($id);
	public function destroy($request);
}
