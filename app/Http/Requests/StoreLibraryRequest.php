<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibraryRequest extends FormRequest
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
			'book_name' => 'required|string',
			'stage_id' => 'required|exists:stages,id',
			'teacher_id' => 'required|exists:teachers,id',
			'grade_id' => 'required|exists:grades,id',
			'section_id' => 'required|exists:sections,id',
		];
	}
	public function messages()
	{
		return [
			'book_name.required' => trans('library.BookNameRequired'),
			'book_name.string' => trans('library.BookNameString'),
			'stage_id.required' => trans('quiz.stageRequired'),
			'grade_id.required' => trans('quiz.gradeRequired'),
			'stage_id.exists' => trans('quiz.stageExists'),
			'grade_id.exists' => trans('quiz.gradeExists'),
			'teacher_id.required' => trans('quiz.teacherIdRequired'),
			'teacher_id.exists' => trans('quiz.teacherExists'),
			'section_id.required' => trans('quiz.sectionIdRequired'),
			'section_id.exists' => trans('quiz.sectionIdExists'),
		];
	}
}
