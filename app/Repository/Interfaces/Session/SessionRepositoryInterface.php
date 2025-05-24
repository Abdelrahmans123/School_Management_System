<?php

namespace App\Repository\Interfaces\Session;

interface SessionRepositoryInterface
{
	public function index();
	public function create();
	public function store($request);
	public function update($request);
	public function destroy($request);
	public function indirectSession();
	public function indirectSessionStore($request);
}
