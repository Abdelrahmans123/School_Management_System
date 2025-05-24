<?php

namespace App\Http\Controllers\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeInvoiceRequest;
use App\Repository\Interfaces\Fee\FeeInvoiceRepositoryInterface;

class FeeInvoiceController extends Controller
{
	protected $feeInvoice;
	public function __construct(FeeInvoiceRepositoryInterface $feeInvoiceRepositoryInterface)
	{
		$this->feeInvoice = $feeInvoiceRepositoryInterface;
	}
	public function index()
	{
		return $this->feeInvoice->index();
	}

	public function store(FeeInvoiceRequest $request)
	{
		return $this->feeInvoice->store($request);
	}

	public function show($id)
	{
		return $this->feeInvoice->show($id);
	}

	public function edit($id)
	{
		return $this->feeInvoice->edit($id);
	}

	public function update(FeeInvoiceRequest $request)
	{
		return $this->feeInvoice->update($request);
	}
	public function destroy(Request $request)
	{
		return $this->feeInvoice->destroy($request);
	}
}
