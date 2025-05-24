<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Parent\ParentRepositoryInterface;
use Illuminate\Http\Request;

class ParentController extends Controller
{
	protected $parent;
	public function __construct(ParentRepositoryInterface $parentRepositoryInterface)
	{
		$this->parent = $parentRepositoryInterface;
	}
	public function index()
	{
		return $this->parent->index();
	}
	public function dashboard()
	{
		return $this->parent->dashboard();
	}
	public function create()
	{
		return $this->parent->create();
	}
	public function students()
	{
		return $this->parent->students();
	}
	public function studentResults($student_id)
	{
		return $this->parent->studentResults($student_id);
	}
	public function studentAttendance()
	{
		return $this->parent->studentAttendance();
	}
	public function search(Request $request)
	{
		return $this->parent->search($request);
	}
	public function studentFee()
	{
		return $this->parent->studentFee();
	}
	public function receipt($id)
	{
		return $this->parent->receipt($id);
	}
}
