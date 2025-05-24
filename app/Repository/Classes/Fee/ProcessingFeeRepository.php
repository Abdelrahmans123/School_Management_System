<?php

namespace App\Repository\Classes\Fee;

use App\Models\Student;
use App\Models\ProcessingFee;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Fee\ProcessingFeeRepositoryInterface;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{
	public function index()
	{
		$processing = ProcessingFee::all();
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Fee.ProcessingFee.index', compact('processing', 'translations'));
	}
	public function create() {}
	public function show($id)
	{
		$student = Student::findOrFail($id);
		return view('Pages.Fee.ProcessingFee.create', compact('student'));
	}
	public function store($request)
	{
		DB::beginTransaction();
		try {
			$validated = $request->validated();

			$processing = new ProcessingFee();
			$processing->date = date('Y-m-d');
			$processing->student_id = $request->studentId;
			$processing->amount = $request->amount;
			$processing->description = $request->description;
			$processing->save();

			$studentAccount = new StudentAccount();
			$studentAccount->date = date('Y-m-d');
			$studentAccount->debit = 0.00;
			$studentAccount->credit = $request->amount;
			$studentAccount->description = $request->description;
			$studentAccount->type = 'processing';
			$studentAccount->student_id = $request->studentId;
			$studentAccount->processing_id = $processing->id;
			$studentAccount->save();
			DB::commit();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('processing.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('processing.index');
		}
	}
	public function edit($id)
	{
		$processing = ProcessingFee::findOrFail($id);
		return view('Pages.Fee.ProcessingFee.edit', compact('processing'));
	}
	public function update($request)
	{
		$id = $request->id;
		DB::beginTransaction();
		try {
			$validated = $request->validated();

			$processing = ProcessingFee::findOrFail($id);
			$processing->date = date('Y-m-d');
			$processing->amount = $request->amount;
			$processing->description = $request->description;
			$processing->save();

			$studentAccount = StudentAccount::where('processing_id', $processing->id)->first();
			$studentAccount->date = date('Y-m-d');
			$studentAccount->credit = $request->amount;
			$studentAccount->description = $request->description;
			$studentAccount->save();
			DB::commit();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('processing.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('processing.index');
		}
	}
	public function destroy($request)
	{
		$id = $request->id;
		$processing = ProcessingFee::findOrFail($id)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('processing.index');
	}
}
