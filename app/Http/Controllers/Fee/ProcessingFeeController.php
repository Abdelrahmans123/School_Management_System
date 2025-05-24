<?php

namespace App\Http\Controllers\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessingFeeRequest;
use App\Repository\Interfaces\Fee\ProcessingFeeRepositoryInterface;

class ProcessingFeeController extends Controller
{
	protected $processingFee;
	public function __construct(ProcessingFeeRepositoryInterface $processingFeeRepositoryInterface)
	{
		$this->processingFee = $processingFeeRepositoryInterface;
	}
	public function index()
	{
		return $this->processingFee->index();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return $this->processingFee->create();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProcessingFeeRequest $request)
	{
		return $this->processingFee->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return $this->processingFee->show($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return $this->processingFee->edit($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProcessingFeeRequest $request)
	{
		return $this->processingFee->update($request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		return $this->processingFee->destroy($request);
	}
}
