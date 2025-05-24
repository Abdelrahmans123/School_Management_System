<?php

namespace App\Http\Controllers\Subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Repository\Interfaces\Subject\SubjectRepositoryInterface;

class SubjectController extends Controller
{
	protected $subject;
	public function __construct(SubjectRepositoryInterface $subjectRepositoryInterface)
	{
		$this->subject = $subjectRepositoryInterface;
	}
	public function index()
	{
		return $this->subject->index();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreSubjectRequest $request)
	{
		return $this->subject->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function getSpecialization($id)
	{
		return $this->subject->getSpecialization($id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreSubjectRequest $request)
	{
		return $this->subject->update($request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		return $this->subject->destroy($request);
	}
}
