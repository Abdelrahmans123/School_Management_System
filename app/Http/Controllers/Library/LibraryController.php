<?php

namespace App\Http\Controllers\Library;

use App\Models\Library;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLibraryRequest;
use App\Repository\Interfaces\Library\LibraryRepositoryInterface;

class LibraryController extends Controller
{
	protected $library;
	public function __construct(LibraryRepositoryInterface $libraryRepositoryInterface)
	{
		$this->library = $libraryRepositoryInterface;
	}
	public function index()
	{
		return $this->library->index();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return $this->library->create();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreLibraryRequest $request)
	{
		return $this->library->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return $this->library->show($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return $this->library->edit($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreLibraryRequest $request)
	{
		return $this->library->update($request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		return $this->library->destroy($request);
	}
	public function download($fileName)
	{
		return $this->library->download($fileName);
	}
	public function getLibraries()
	{
		$books = Library::with(['stages', 'grades', 'sections', 'teachers'])->get();
		return DataTables::of($books)
			->addIndexColumn()
			->addColumn('stage_name', function ($row) {
				return $row->stages->Name;
			})
			->addColumn('grade_name', function ($row) {
				return $row->grades->name;
			})
			->addColumn('section_name', function ($row) {
				return $row->sections->name;
			})
			->addColumn('teacher_name', function ($row) {
				return $row->teachers->name;
			})
			->addColumn('action', function ($row) {
				return ''; // Leave empty, this will be handled on client-side by DataTables render function
			})
			->rawColumns(['action'])
			->make(true);
	}
}
