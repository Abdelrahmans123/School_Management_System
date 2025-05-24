<?php

namespace App\Repository\Classes\Parent;

use App\Models\Attendance;
use App\Models\ReceiptStudent;
use App\Models\Religion;
use App\Models\BloodType;
use App\Models\Degree;
use App\Models\FeeInvoice;
use App\Models\Nationality;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Parent\ParentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ParentRepository implements ParentRepositoryInterface
{
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('livewire.showForm', compact('translations'));
	}

	public function dashboard()
	{
		$students = Student::where('parent_id', auth()->user()->id)->get();

		// Get subject-wise GPAs
		$subjectGpas = Degree::whereIn('student_id', $students->pluck('id'))
			->where('abuse', '0')
			->with('question.subject') // eager load subject through question
			->get()
			->groupBy(fn($degree) => $degree->question->subject->name)
			->map(function ($degrees, $subjectName) {
				$average = $degrees->avg('score');

				// Optional: convert to 4.0 scale
				$gpa = match (true) {
					$average >= 90 => 4.0,
					$average >= 80 => 3.0,
					$average >= 70 => 2.0,
					$average >= 60 => 1.0,
					default => 0.0,
				};

				return [
					'subject' => $subjectName,
					'average' => round($average, 2),
					'gpa' => $gpa
				];
			});

		// Get student performance for each student
		$studentPerformance = [];
		$studentAttendance = [];
		foreach ($students as $student) {
			$studentAttendance[$student->id] = $this->getStudentAttendance($student->id);
			$studentPerformance[$student->id] = $this->getStudentPerformance($student->id);
		}

		// Pass data to the view
		return view('Pages.Parent.Dashboard.dashboard', compact('students', 'subjectGpas', 'studentPerformance', 'studentAttendance'));
	}

	public function getStudentPerformance($studentId)
	{
		// Fetching student performance by month (you can change it to year, etc.)
		$performanceData = DB::table('degrees')
			->select(
				DB::raw('MONTH(degrees.date) as month'),
				DB::raw('YEAR(degrees.date) as year'),
				DB::raw('AVG(degrees.score) as average_score')
			)
			->join('questions', 'questions.id', '=', 'degrees.question_id') // Optional: Join with other tables if needed
			->where('degrees.student_id', $studentId)
			->where('degrees.abuse', '0') // Exclude abused records
			->groupBy(DB::raw('YEAR(degrees.date), MONTH(degrees.date)'))
			->orderBy(DB::raw('YEAR(degrees.date), MONTH(degrees.date)'))
			->get();

		// Format the results as an array of months and scores
		return $performanceData->map(function ($item) {
			return [
				'month' => \Carbon\Carbon::createFromDate($item->year, $item->month, 1)->format('F Y'), // Get the month name (e.g., January 2025)
				'score' => round($item->average_score, 2) // Average GPA or score for the month
			];
		});
	}
	public function getStudentAttendance($studentId)
	{
		// Fetch attendance data for the student, grouped by month
		$attendanceData = DB::table('attendances')
			->select(
				DB::raw('MONTH(attendances.date) as month'),
				DB::raw('YEAR(attendances.date) as year'),
				DB::raw('COUNT(CASE WHEN attendances.status = 1 THEN 1 END) as present_days'),
				DB::raw('COUNT(CASE WHEN attendances.status = 0 THEN 1 END) as absent_days')
			)
			->where('attendances.student_id', $studentId)
			->groupBy(DB::raw('YEAR(attendances.date), MONTH(attendances.date)'))
			->orderBy(DB::raw('YEAR(attendances.date), MONTH(attendances.date)'))
			->get();

		// Format the results as an array of months, present and absent days
		return $attendanceData->map(function ($item) {
			return [
				'month' => \Carbon\Carbon::createFromDate($item->year, $item->month, 1)->format('F Y'),
				'present' => $item->present_days,
				'absent' => $item->absent_days
			];
		});
	}

	public function create()
	{
		$nationalities = Nationality::all();
		$bloodTypes = BloodType::all();
		$religions = Religion::all();
		return view('Pages.Parent.create', compact('nationalities', 'bloodTypes'))->with(['religions' => $religions]);
	}
	public function students()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$students = Student::where('parent_id', auth()->user()->id)->get();
		return view('Pages.Parent.Student.index', compact('students', 'translations'));
	}
	public function studentResults($student_id)
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$student = Student::where('parent_id', auth()->user()->id)->where('id', $student_id)->first();
		if (!$student) {
			flash()->addError('Student not found');
			return redirect()->route('parent.students');
		}
		$degrees = Degree::where('student_id', $student_id)->get();
		if ($degrees->isEmpty()) {
			flash()->addError('No results found for this student');
			return redirect()->route('parent.students');
		}
		return view('Pages.Parent.Student.result', compact('degrees', 'translations'));
	}
	public function studentAttendance()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$students = Student::where('parent_id', auth()->user()->id)->get();
		if ($students->isEmpty()) {
			flash()->addError('Student not found');
			return redirect()->route('parent.students');
		}
		$studentSearch = session('studentSearch', collect());
		return view('Pages.Parent.Student.attendance', compact('translations', 'students'));
	}
	public function search($request)
	{
		try {
			$student_id = $request->student_id;
			$start_date = $request->start_date;
			$end_date = $request->end_date;

			$langFile = 'datatables';
			$translations = Lang::get($langFile);
			$students = Student::where('parent_id', auth()->user()->id)->get();
			if ($students->isEmpty()) {
				flash()->addError('Student not found');
				return redirect()->route('parent.students');
			}
			if ($start_date > $end_date) {
				flash()->addError('The start date must be less than the end date');
				return redirect()->back();
			}
			$query = '';
			if ($start_date != null && $end_date !== null) {
				$query = Attendance::whereBetween('date', [$start_date, $end_date])->get();
			}
			if ($student_id == 0 && $start_date == null && $end_date == null) {
				$query = Attendance::all();
			}
			if ($student_id != 0) {
				$query = Attendance::where('student_id', $student_id)->get();
			}
			$studentSearch = $query;
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
	public function studentFee()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$students = Student::where('parent_id', auth()->user()->id)->pluck('id')->toArray();
		$student = Student::where('parent_id', auth()->user()->id)->get();
		if ($student->isEmpty()) {
			flash()->addError('Student not found');
			return redirect()->route('parent.students');
		}

		$fees = FeeInvoice::whereIn('student_id', $students)->get();

		if ($fees->isEmpty()) {
			flash()->addError('No fees found for this student');
			return redirect()->route('parent.students');
		}
		return view('Pages.Parent.Fee.index', compact('translations', 'fees'));
	}
	public function receipt($id)
	{
		$student = Student::where('parent_id', auth()->user()->id)->first();
		if (!$student) {
			flash()->addError('Student not found');
			return redirect()->route('parent.student.fee');
		}
		$receipt = ReceiptStudent::where('student_id', $id)->get();
		if ($receipt->isEmpty()) {
			flash()->addError(trans('message.noReceiptFound'));
			return redirect()->route('parent.student.fee');
		}
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		return view('Pages.Parent.Fee.Receipt.index', compact('translations', 'receipt'));
	}
}
