<?php

namespace App\Repository\Classes\Fee;

use App\Models\Fee;
use App\Models\Stage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Fee\FeeRepositoryInterface;


class FeeRepository implements FeeRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$fees = Fee::all();
		$stages = Stage::all();
		$url = URL::to(App::getLocale() . '/admin/getGrade');
		return view('Pages.Fee.index', compact('translations', 'fees', 'stages', 'url'));
	}
	public function store($request)
	{
		try {
			$validated = $request->validated();
			$translations = ['en' => $request->titleEn, 'ar' => $request->titleAR];
			$fee = new Fee();
			$fee->title = $translations;
			$fee->amount = $request->amount;
			$fee->stage_id = $request->stageId;
			$fee->grade_id = $request->gradeId;
			$fee->description = $request->description;
			$fee->year = $request->year;
			$fee->type = $request->feeType;
			$fee->save();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('fee.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('fee.index');
		}
	}
	public function update($request)
	{
		try {
			$validated = $request->validated();
			$translations = ['en' => $request->titleEn, 'ar' => $request->titleAR];
			$fee = Fee::findOrFail($request->id);
			$fee->title = $translations;
			$fee->amount = $request->amount;
			$fee->stage_id = $request->stageId;
			$fee->grade_id = $request->gradeId;
			$fee->description = $request->description;
			$fee->year = $request->year;
			$fee->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('fee.index');
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('fee.index');
		}
	}
	public function destroy($request)
	{
		$fee = Fee::findOrFail($request->id)->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('fee.index');
	}
	public function getFee($id)
	{
		$fee = Fee::findOrFail($id);
		return response()->json($fee);
	}
}
