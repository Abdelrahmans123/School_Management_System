<?php

namespace App\Repository\Classes\Fee;

use App\Models\Fee;
use App\Models\Stage;
use App\Models\Student;
use App\DTO\FeeInvoiceDTO;
use App\Models\FeeInvoice;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Fee\FeeInvoiceRepositoryInterface;

class FeeInvoiceRepository implements FeeInvoiceRepositoryInterface
{
	public function index()
	{
		$feeInvoice = FeeInvoice::all();
		$stages = Stage::all();
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Fee.Invoice.index', compact('feeInvoice', 'stages', 'translations'));
	}
	public function show($id)
	{
		$student = Student::findOrFail($id);
		$url = URL::to(App::getLocale() . '/admin/getFee');
		$fee = Fee::where('stage_id', $student->stage_id)->get();
		return view('Pages.Fee.Invoice.create', compact('fee', 'student', 'url'));
	}
	public function edit($id)
	{
		$feeInvoice = FeeInvoice::findOrFail($id);
		$url = URL::to(App::getLocale() . '/admin/getFee');
		$fee = Fee::where('stage_id', $feeInvoice->stage_id)->get();
		return view('Pages.Fee.Invoice.edit', compact('feeInvoice', 'url', 'fee'));
	}
	public function store($request)
	{
		$feesList = array_map(fn ($item) => new FeeInvoiceDTO(
			floatval($item['amount']),
			$item['description'] ?? null, // Allow null and provide default if needed
			$item['feeType'],
			$item['studentId']
		), $request->feesList);

		DB::beginTransaction();
		try {
			$validated = $request->validated();
			foreach ($feesList as $item) {
				$feeInvoice = new FeeInvoice();
				$feeInvoice->date = date('Y-m-d');
				$feeInvoice->amount = $item->amount;
				$feeInvoice->description = $item->description;
				$feeInvoice->student_id = $item->studentId;
				$feeInvoice->stage_id = $request->stageId;
				$feeInvoice->grade_id = $request->gradeId;
				$feeInvoice->fee_id = $item->feeType;
				$feeInvoice->save();

				$studentAccount = new StudentAccount();
				$studentAccount->date = date('Y-m-d');
				$studentAccount->debit = $item->amount;
				$studentAccount->credit = 0.00;
				$studentAccount->description = $item->description;
				$studentAccount->type = 'invoice';
				$studentAccount->invoice_id = $feeInvoice->id;
				$studentAccount->student_id = $item->studentId;
				$studentAccount->save();
			}

			DB::commit();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('invoice.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('invoice.index');
		}
	}
	public function update($request)
	{
		$id = $request->id;
		DB::beginTransaction();
		try {
			$validated = $request->validated();
			$feeInvoice = FeeInvoice::findOrFail($id);
			$feeInvoice->date = date('Y-m-d');
			$feeInvoice->amount = $request->amount;
			$feeInvoice->description = $request->description;
			$feeInvoice->fee_id = $request->feeType;
			$feeInvoice->save();

			$studentAccount = StudentAccount::where('invoice_id', $id);
			$studentAccount->debit = $request->amount;
			$studentAccount->description = $request->description;
			$studentAccount->save();

			DB::commit();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('invoice.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('invoice.index');
		}
	}
	public function destroy($request)
	{
		try {
			$feeInvoice = FeeInvoice::findOrFail($request->id)->delete();
			flash()->addSuccess(trans('message.dataDeleted'));
			return redirect()->route('invoice.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('invoice.index');
		}
	}
}
