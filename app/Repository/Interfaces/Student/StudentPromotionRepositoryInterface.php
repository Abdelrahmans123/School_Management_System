<?php
namespace App\Repository\Interfaces\Student;
interface StudentPromotionRepositoryInterface{
	public function index();
	public function create();
	public function store($request);
	public function retreat($request);
}
