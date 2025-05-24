<?php

namespace App\Repository\Classes\Student;

use App\Models\Attendance;
use App\Models\Guardian;
use App\Models\Stage;
use App\Models\Student;
use App\Models\Teacher;
use App\Notifications\ParentNotification;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Student\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$teacher = auth()->user();
		// Retrieve stages with only the sections assigned to this teacher
		$stages = Stage::with(['section' => function ($query) use ($teacher) {
			$query->whereHas('teachers', function ($q) use ($teacher) {
				$q->where('teacher_id', $teacher->id);
			});
		}])->get();
		$teachers = Teacher::all();
		return view('Pages.Student.Attendance.index', compact('teachers', 'stages', 'translations'));
	}
	public function create() {}
	public function show($attendance)
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$students = Student::with('attendance')->where('section_id', $attendance)->get();

		return view('Pages.Student.Attendance.show', compact('students', 'translations'));
	}
	public function store($request)
	{
		try {
			// dd($request);
			foreach ($request->attendance as $studentId => $attendance) {
				if ($attendance === 'attend') {
					$status = true;
				} else {
					$status = false;
				}

				// Use updateOrCreate to prevent duplicate entries
				Attendance::updateOrCreate(
					['student_id' => $studentId, 'date' => date('Y-m-d')],
					[
						'stage_id' => $request->stageId,
						'grade_id' => $request->gradeId,
						'section_id' => $request->sectionId,
						'teacher_id' => auth()->user()->id,
						'status' => $status,
					]
				);
				// When marking a student absent
if (!$attendance->status) {
    $student = Student::find($attendance->student_id);
    $guardian = Guardian::find($student->parent_id);
    $guardian->notify(new ParentNotification(
        'Attendance Alert',
        $student->name . ' was marked absent today',
        'warning'
    ));
}
			}

			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->back(); // Preserve old inputs

		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->back();
		}
	}

	public function update($request, $attendance)
	{
		try {
			$studentId = $request->student_id;
			if ($request->attendance_status === 'attend') {
				$status = true;
			} else {
				$status = false;
			}

			Attendance::updateOrCreate(
				['student_id' => $studentId, 'date' => date('Y-m-d')],
				['status' => $status]
			);

			flash()->addSuccess(__('message.dataSaved'), [], []);

			return redirect()->back();
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->back();
		}
	}
	public function destroy($request) {}
	public function report()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$sectionIds = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
		$students = Student::whereIn('section_id', $sectionIds)->get();
		$studentSearch = session('studentSearch', collect());
		return view('pages.student.attendance.report', compact('students', 'translations'));
	}
	public function search($request)
	{
		try {
			$validated = $request->validated();
			$student_id = $request->student_id;
			$start_date = $request->start_date;
			$end_date = $request->end_date;

			$langFile = 'datatables';
			$translations = Lang::get($langFile);
			$sectionIds = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
			$students = Student::whereIn('section_id', $sectionIds)->get();

			$query = Attendance::whereBetween('date', [$start_date, $end_date]);

			if ($student_id != 0) {
				$query->where('student_id', $student_id);
			}

			$studentSearch = $query->get();
			flash()->addSuccess(__('message.dataSaved'));
			return redirect()->back()
				->with([
					'students' => $students,
					'translations' => $translations,
					'studentSearch' => $studentSearch
				]);
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->back();
		}
	}
}
