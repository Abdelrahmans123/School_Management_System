<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
			'stageId' => 'required|exists:stages,id',
			'gradeId' => 'required|exists:grades,id',
			'teacherId' => 'required|exists:teachers,id',
			'subjectAr' => 'required',
			'subjectEn' => 'required',
		];
	}
	public function messages()
	{
		return [
			'subjectEn.required' => trans('subject.NameEnRequired'),
			'subjectAr.required' => trans('subject.NameArRequired'),
			'stageId.required' => trans('section.stageRequired'),
			'gradeId.required' => trans('section.gradeRequired'),
			'stageId.exists' => trans('section.stageExists'),
			'gradeId.exists' => trans('section.gradeExists'),
			'teacherId.required' => trans('section.teacherIdRequired'),
		];
	}
}
