<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'title' => 'required|string',
			'answers' => 'required|string',
			'right_answer' => 'required|string',
			'score' => 'required|string',
		];
	}
	public function messages()
	{
		return [
			'title.required' => trans('question.titleRequired'),
			'answers.required' => trans('question.answersRequired'),
			'right_answer.required' => trans('question.rightAnswerRequired'),
			'score.required' => trans('question.scoreRequired'),
			'title.string' => trans('question.titleString'),
			'answers.string' => trans('question.answersString'),
			'right_answer.string' => trans('question.rightAnswerString'),
			'score.string' => trans('question.scoreString'),
		];
	}
}
