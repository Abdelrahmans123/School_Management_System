<?php

namespace App\Repository\Classes\Fee;

use App\Models\Payment;
use App\Models\Student;
use App\Models\FundAccount;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Fee\PaymentFeeRepositoryInterface;

class PaymentFeeRepository implements PaymentFeeRepositoryInterface
{
	public function index()
	{
		$payment = Payment::all();
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Fee.Payment.index', compact('payment', 'translations'));
	}
	public function create() {}
	public function show($id)
	{
		$student = Student::findOrFail($id);
		return view('Pages.Fee.Payment.create', compact('student'));
	}
	public function store($request)
	{
		DB::beginTransaction();
		try {
			$validated = $request->validated();
			$payment = new Payment();
			$payment->date = date('Y-m-d');
			$payment->student_id = $request->studentId;
			$payment->amount = $request->amount;
			$payment->description = $request->description;
			$payment->save();

			$fundAccount = new FundAccount();
			$fundAccount->date = date('Y-m-d');
			$fundAccount->payment_id = $payment->id;
			$fundAccount->debit = 0.00;
			$fundAccount->credit = $request->amount;
			$fundAccount->description = $request->description;
			$fundAccount->save();

			$studentAccount = new StudentAccount();
			$studentAccount->date = date('Y-m-d');
			$studentAccount->debit = 0.00;
			$studentAccount->credit = $request->amount;
			$studentAccount->description = $request->description;
			$studentAccount->type = 'payment';
			$studentAccount->student_id = $request->studentId;
			$studentAccount->payment_id = $payment->id;
			$studentAccount->save();
			DB::commit();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('payment.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('payment.index');
		}
	}
	public function edit($id)
	{
		$payment = Payment::findOrFail($id);
		return view('Pages.Fee.Payment.edit', compact('payment'));
	}
	public function update($request)
	{
		$id = $request->id;
		DB::beginTransaction();
		try {
			$validated = $request->validated();

			$payment = Payment::findOrFail($id);
			$payment->date = date('Y-m-d');
			$payment->amount = $request->amount;
			$payment->description = $request->description;
			$payment->save();

			$fundAccount = FundAccount::where('payment_id', $payment->id)->first();
			$fundAccount->date = date('Y-m-d');
			$fundAccount->payment_id = $payment->id;
			$fundAccount->debit = 0.00;
			$fundAccount->credit = $request->amount;
			$fundAccount->description = $request->description;
			$fundAccount->save();

			$studentAccount = StudentAccount::where('payment_id', $payment->id)->first();
			$studentAccount->date = date('Y-m-d');
			$studentAccount->credit = $request->amount;
			$studentAccount->description = $request->description;
			$studentAccount->save();
			DB::commit();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('payment.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('payment.index');
		}
	}
	public function destroy($request)
	{
		$id = $request->id;
		Payment::findOrFail($id)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('payment.index');
	}
}
