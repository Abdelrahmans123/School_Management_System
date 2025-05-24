<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceReportSearch;
use App\Http\Requests\StoreAttendanceRequest;
use App\Repository\Interfaces\Student\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{
	protected $attendances;
	public function __construct(AttendanceRepositoryInterface $attendanceRepositoryInterface)
	{
		$this->attendances = $attendanceRepositoryInterface;
	}
	public function index()
	{
		return $this->attendances->index();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return $this->attendances->create();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreAttendanceRequest $request)
	{
		return $this->attendances->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($attendance)
	{
		return $this->attendances->show($attendance);
	}


	public function update(Request $request, $attendance)
	{
		return $this->attendances->update($request, $attendance);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		return $this->attendances->destroy($request);
	}
	public function report()
	{
		return $this->attendances->report();
	}
	public function search(AttendanceReportSearch $request)
	{
		return $this->attendances->search($request);
	}
}
