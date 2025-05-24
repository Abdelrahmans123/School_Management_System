<?php

namespace App\Repository\Classes\Question;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\Lang;
use App\Repository\Interfaces\Question\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
	// Implementation of QuestionRepositoryInterface methods will go here
	public function index()
	{
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$questions = Question::all();
		return view('Pages.Question.index', compact('questions', 'translations'));
	}
	public function create($id)
	{
		$quiz = Quiz::findOrFail($id);
		return view('Pages.Question.create', compact('quiz'));
	}
	public function store($request)
	{
		try {
			$validatedData = $request->validated();
			$question = new Question();
			$question->title = $request->title;
			$question->answers = $request->answers;
			$question->right_answer = $request->right_answer;
			$question->score = $request->score;
			$question->quiz_id = $request->quiz_id;
			$question->subject_id = Quiz::findOrFail($request->quiz_id)->subject_id;
			$question->save();
			flash()->addSuccess(trans('message.dataSaved'));
			return redirect()->route('teacher.question.show', $request->quiz_id);
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('teacher.question.show', $request->quiz_id);
		}
	}
	public function edit($id)
	{
		$question = Question::findOrFail($id);
		$quizzes = Quiz::all();
		return view('Pages.Question.edit', compact('question', 'quizzes'));
	}
	public function show($id)
	{
		$quiz = Quiz::findOrFail($id);
		$questions = Question::where('quiz_id', $id)->get();
		$translations = Lang::get('datatables');
		return view('Pages.Question.index', compact('quiz', 'questions', 'translations'));
	}
	public function update($request)
	{
		try {
			$validatedData = $request->validated();
			$question = Question::findOrFail($request->question_id);
			$question->title = $request->title;
			$question->answers = $request->answers;
			$question->right_answer = $request->right_answer;
			$question->score = $request->score;
			$question->quiz_id = $request->quiz_id;
			$question->subject_id = Quiz::findOrFail($request->quiz_id)->subject_id;

			$question->save();
			flash()->addSuccess(trans('message.dataUpdated'));
			return redirect()->route('teacher.question.show', $request->quiz_id);
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->route('teacher.question.show', $request->quiz_id);
		}
	}
	public function destroy($request)
	{
		try {
			$question = Question::findOrFail($request->question_id);
			$question->delete();
			flash()->addSuccess(trans('message.dataDeleted'));
			return redirect()->back();
		} catch (\Exception $e) {
			flash()->addError($e->getMessage());
			return redirect()->back();
		}
	}
}
