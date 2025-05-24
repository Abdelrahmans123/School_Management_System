<?php

namespace App\Http\Controllers\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeRequest;
use App\Repository\Interfaces\Fee\FeeRepositoryInterface;

class FeeController extends Controller
{
	protected $fee;
	public function __construct(FeeRepositoryInterface $feeRepositoryInterface)
	{
		$this->fee = $feeRepositoryInterface;
	}

	public function index()
	{
		return $this->fee->index();
	}

	public function store(StoreFeeRequest $request)
	{
		return $this->fee->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function getFee($id)
	{
		return $this->fee->getFee($id);
	}


	public function update(StoreFeeRequest $request)
	{
		return $this->fee->update($request);
	}

	public function destroy(Request $request)
	{
		return $this->fee->destroy($request);
	}
}
