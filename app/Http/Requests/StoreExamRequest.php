<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
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
			'examEn' => 'required',
			'examAr' => 'required',
			'academicYear' => 'required',
			'term' => 'required|numeric|integer',
		];
	}
	public function messages()
	{
		return [
			'examEn.required' => trans('exam.NameEnRequired'),
			'examAr.required' => trans('exam.NameArRequired'),
			'academicYear.required' => trans('exam.academicYearRequired'),
			'term.required' => trans('exam.termRequired'),
		];
	}
}
