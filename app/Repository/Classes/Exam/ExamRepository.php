<?php

namespace App\Repository\Classes\Exam;

use App\Models\Exam;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Exam\ExamRepositoryInterface;



class ExamRepository implements ExamRepositoryInterface
{
	/**
	 * Retrieves a list of all exams and returns a view with the exam data and translations.
	 *
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$exams = Exam::all();
		return view('Pages.Exam.index', compact('translations', 'exams'));
	}

	/**
	 * Stores a new exam record in the database.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function store($request)
	{
		// Validate the request data
		$validated = $request->validated();

		// Create a new Exam model instance
		$exam = new Exam();

		// Set the exam name translations
		$translations = ['en' => $request->examEn, 'ar' => $request->examAr];
		$exam->setTranslations('name', $translations);

		// Set the other exam properties
		$exam->term = $request->term;
		$exam->academicYear = $request->academicYear;

		// Save the exam record
		$exam->save();

		// Flash a success message and redirect to the exam index page
		flash()->addSuccess(trans('message.dataSaved'));
		return redirect()->route('teacher.exam.index');
	}

	/**
	 * Updates an existing exam record in the database.
	 *
	 * @param \Illuminate\Http\Request $request The HTTP request containing the updated exam data.
	 * @return \Illuminate\Http\RedirectResponse Redirects to the exam index page.
	 * @throws \Exception If the exam record cannot be updated.
	 */
	public function update($request)
	{
		// Validate the request data
		$validated = $request->validated();
		$id = $request->id;

		$exam = Exam::findOrFail($id);

		// Set the exam name translations
		$translations = ['en' => $request->examEn, 'ar' => $request->examAr];
		$exam->setTranslations('name', $translations);

		// Set the other exam properties
		$exam->term = $request->term;
		$exam->academicYear = $request->academicYear;

		// Save the exam record
		$exam->save();

		// Flash a success message and redirect to the exam index page
		flash()->addSuccess(trans('message.dataSaved'));
		return redirect()->route('teacher.exam.index');
	}

	public function destroy($request)
	{
		$id = $request->id;
		$exam = Exam::findOrFail($id);
		$exam->delete();
		flash()->addSuccess(trans('message.dataDeleted'));
		return redirect()->route('teacher.exam.index');
	}
}
