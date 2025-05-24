<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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

			'sectionEn' => 'required',
			'sectionAr' => 'required',
			'stageId' => 'required|exists:stages,id',
			'gradeId' => 'required|exists:grades,id',
			'teachersId' => 'required|array|min:1',
			'teachersId.*' => 'exists:teachers,id',
		];
	}
	public function messages()
	{
		return [
			'sectionEn.required' => trans('section.NameEnRequired'),
			'sectionAr.required' => trans('section.NameArRequired'),
			'stageId.required' => trans('section.stageRequired'),
			'gradeId.required' => trans('section.gradeRequired'),
			'stageId.exists' => trans('section.stageExists'),
			'gradeId.exists' => trans('section.gradeExists'),
			'teachersId.required' => trans('section.teacherIdRequired'),
		];
	}
}
