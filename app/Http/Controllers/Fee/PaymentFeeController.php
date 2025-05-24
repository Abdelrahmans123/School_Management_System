<?php

namespace App\Http\Controllers\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentFeeRequest;
use App\Repository\Interfaces\Fee\PaymentFeeRepositoryInterface;

class PaymentFeeController extends Controller
{
	protected $paymentFee;
	public function __construct(PaymentFeeRepositoryInterface $paymentFeeRepositoryInterface)
	{
		$this->paymentFee = $paymentFeeRepositoryInterface;
	}
	public function index()
	{
		return $this->paymentFee->index();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return $this->paymentFee->create();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PaymentFeeRequest $request)
	{
		return $this->paymentFee->store($request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return $this->paymentFee->show($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return $this->paymentFee->edit($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(PaymentFeeRequest $request)
	{
		return $this->paymentFee->update($request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		return $this->paymentFee->destroy($request);
	}
}
