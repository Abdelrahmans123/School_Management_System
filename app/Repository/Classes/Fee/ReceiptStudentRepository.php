<?php

namespace App\Repository\Classes\Fee;

use App\Models\Student;
use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Fee\ReceiptStudentRepositoryInterface;


class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{
	public function index()
	{
		$receipt = ReceiptStudent::all();
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Fee.Receipt.index', compact('receipt', 'translations'));
	}
	public function create() {}
	public function store($request)
	{
		DB::beginTransaction();
		try {
			$validated = $request->validated();
			$receipt = new ReceiptStudent();
			$receipt->date = date('Y-m-d');
			$receipt->student_id = $request->studentId;
			$receipt->debit = $request->amount;
			$receipt->description = $request->description;
			$receipt->save();

			$fundAccount = new FundAccount();
			$fundAccount->date = date('Y-m-d');
			$fundAccount->receipt_id = $receipt->id;
			$fundAccount->debit = $request->amount;
			$fundAccount->credit = 0.00;
			$fundAccount->description = $request->description;
			$fundAccount->save();

			$studentAccount = new StudentAccount();
			$studentAccount->date = date('Y-m-d');
			$studentAccount->debit = 0.00;
			$studentAccount->credit = $request->amount;
			$studentAccount->description = $request->description;
			$studentAccount->type = 'receipt';
			$studentAccount->receipt_id = $receipt->id;
			$studentAccount->student_id = $request->studentId;
			$studentAccount->save();
			DB::commit();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('receipt.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('receipt.index');
		}
	}
	public function show($id)
	{
		$student = Student::findOrFail($id);
		return view('Pages.Fee.Receipt.create', compact('student'));
	}
	public function edit($id)
	{
		$receipt = ReceiptStudent::findOrFail($id);
		return view('Pages.Fee.Receipt.edit', compact('receipt'));
	}
	public function update($request)
	{
		$id = $request->id;
		DB::beginTransaction();
		try {
			$validated = $request->validated();
			$receipt = ReceiptStudent::findOrFail($id);
			$receipt->date = date('Y-m-d');
			$receipt->debit = $request->amount;
			$receipt->description = $request->description;
			$receipt->save();

			$fundAccount = FundAccount::where('receipt_id', $receipt->id)->first();
			$fundAccount->date = date('Y-m-d');
			$fundAccount->debit = $request->amount;
			$fundAccount->description = $request->description;
			$fundAccount->save();

			$studentAccount = StudentAccount::where('receipt_id', $receipt->id)->first();
			$studentAccount->date = date('Y-m-d');
			$studentAccount->credit = $request->amount;
			$studentAccount->description = $request->description;
			$studentAccount->save();
			DB::commit();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('receipt.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('receipt.index');
		}
	}
	public function destroy($request)
	{
		$receipt = ReceiptStudent::findOrFail($request->id);
		$receipt->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('receipt.index');
	}
}
