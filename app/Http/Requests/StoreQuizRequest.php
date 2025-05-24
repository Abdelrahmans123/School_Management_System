<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
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
			'name_en' => 'required|string',
			'name_ar' => 'required|string',
			'stage_id' => 'required|exists:stages,id',
			'subject_id' => 'required|exists:subjects,id',
			'grade_id' => 'required|exists:grades,id',
			'section_id' => 'required|exists:sections,id',
		];
	}
	public function messages()
	{
		return [
			'name_en.required' => trans('quiz.NameEnRequired'),
			'name_ar.required' => trans('quiz.NameArRequired'),
			'name_en.string' => trans('quiz.NameEnString'),
			'name_ar.string' => trans('quiz.NameArString'),
			'stage_id.required' => trans('quiz.stageRequired'),
			'grade_id.required' => trans('quiz.gradeRequired'),
			'stage_id.exists' => trans('quiz.stageExists'),
			'grade_id.exists' => trans('quiz.gradeExists'),
			'subject_id.required' => trans('quiz.subjectIdRequired'),
			'subject_id.exists' => trans('quiz.subjectIdExists'),
			'section_id.required' => trans('quiz.sectionIdRequired'),
			'section_id.exists' => trans('quiz.sectionIdExists'),
		];
	}
}
