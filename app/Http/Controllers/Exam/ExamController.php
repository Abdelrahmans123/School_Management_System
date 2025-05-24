<?php

namespace App\Http\Controllers\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamRequest;
use App\Repository\Interfaces\Exam\ExamRepositoryInterface;

class ExamController extends Controller
{
	protected $exam;
	public function __construct(ExamRepositoryInterface $examRepositoryInterface)
	{
		$this->exam = $examRepositoryInterface;
	}
	public function index()
	{
		return $this->exam->index();
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreExamRequest $request)
	{
		return $this->exam->store($request);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreExamRequest $request)
	{
		return $this->exam->update($request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		return $this->exam->destroy($request);
	}
}
