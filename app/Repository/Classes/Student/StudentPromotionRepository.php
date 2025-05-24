<?php

namespace App\Repository\Classes\Student;

use App\Models\Stage;
use App\Models\Student;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Student\StudentPromotionRepositoryInterface;




class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$promotions = Promotion::all();
		return view('Pages.Student.Promotion.index', compact('translations', 'promotions'));
	}
	public function create()
	{
		$stages = Stage::all();
		$url = URL::to(App::getLocale() . '/getGrade');
		$sectionUrl = URL::to(App::getLocale() . '/getSection');
		return view('Pages.Student.Promotion.create', compact('stages', 'url', 'sectionUrl'));
	}
	public function store($request)
	{
		DB::beginTransaction();
		try {
			$oldStageId = $request->oldStageId;
			$oldGradeId = $request->oldGradeId;
			$oldSectionId = $request->oldSectionId;
			$oldAcademicYear = $request->oldAcademicYear;
			$stageId = $request->stageId;
			$gradeId = $request->gradeId;
			$sectionId = $request->sectionId;
			$academicYear = $request->academicYear;

			$students = Student::where('stage_id', $oldStageId)
				->where('grade_id', $oldGradeId)
				->where('section_id', $oldSectionId)
				->where('academicYear', $oldAcademicYear)
				->get();
			if ($students->count() < 1) {
				flash()->addError(trans('message.noStudents'));
				return redirect()->route('promotion.create');
			}

			foreach ($students as $student) {
				$ids = explode(',', $student->id);
				Student::whereIn('id', $ids)->update([
					'grade_id' => $gradeId,
					'section_id' => $sectionId,
					'stage_id' => $stageId,
					'academicYear' => $academicYear
				]);
				Promotion::updateOrCreate([
					'student_id' => $student->id,
					'fromGrade' => $oldGradeId,
					'fromStage' => $oldStageId,
					'fromSection' => $oldSectionId,
					'oldAcademicYear' => $oldAcademicYear,
					'toGrade' => $gradeId,
					'toStage' => $stageId,
					'toSection' => $sectionId,
					'academicYear' => $academicYear,
				]);
			}
			DB::commit();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('promotion.index');
		} catch (\Exception $e) {
			DB::rollBack();
			flash()->addError($e->getMessage());
			return redirect()->route('promotion.index');
		}
	}
	public function retreat($request)
	{
		DB::beginTransaction();
		try {
			if ($request->pageId == '1') {
				Log::info('Starting retreat transaction for pageId 1');
				$promotions = Promotion::all();

				if ($promotions->isEmpty()) {
					flash()->addError(trans('promotion.noPromotions'));
					DB::rollBack();
					Log::info('No promotions found');
					return redirect()->route('promotion.index');
				}

				foreach ($promotions as $promotion) {
					Log::info('Processing promotion: ' . $promotion->id);
					$ids = explode(',', $promotion->student_id);
					Student::whereIn('id', $ids)->update([
						'grade_id' => $promotion->fromGrade,
						'section_id' => $promotion->fromSection,
						'stage_id' => $promotion->fromStage,
						'academicYear' => $promotion->oldAcademicYear
					]);
				}

				DB::commit();
				Log::info('Retreat transaction committed successfully');
				// Deleting all promotions in a separate transaction
				DB::beginTransaction();
				Promotion::query()->delete();
				DB::commit();
				flash()->addSuccess(trans('promotion.retreatAllSuccess'));
				return redirect()->route('promotion.index');
			} else {
				$promotion = Promotion::findOrFail($request->promotionId);
				Student::where('id', $promotion->student_id)->update([
					'grade_id' => $promotion->fromGrade,
					'section_id' => $promotion->fromSection,
					'stage_id' => $promotion->fromStage,
					'academicYear' => $promotion->oldAcademicYear
				]);
				Promotion::destroy($request->promotionId);
				DB::commit();
				flash()->addSuccess(trans('promotion.retreatSuccess'));
				return redirect()->route('promotion.index');
			}
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error('Retreat transaction failed: ' . $e->getMessage());
			flash()->addError($e->getMessage());
			return redirect()->route('promotion.index');
		}
	}
}
