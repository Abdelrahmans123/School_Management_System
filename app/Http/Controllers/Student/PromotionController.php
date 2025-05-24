<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\Student\StudentPromotionRepositoryInterface;


class PromotionController extends Controller
{
	protected $promotion;
	public function __construct(StudentPromotionRepositoryInterface $promotionInterface)
	{
		$this->promotion = $promotionInterface;
	}

	public function index()
	{
		return $this->promotion->index();
	}

	public function create()
	{
		return $this->promotion->create();
	}
	public function store(Request $request)
	{
		return $this->promotion->store($request);
	}

	public function retreat(Request $request)
	{
		return $this->promotion->retreat($request);
	}
}
