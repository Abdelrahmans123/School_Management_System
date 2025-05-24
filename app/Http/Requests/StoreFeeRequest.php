<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
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
			'titleEn' => 'required',
			'titleAR' => 'required',
			'amount' => 'required|numeric|min:1',
			'year' => 'required',
			'feeType' => 'required',
			'stageId' => 'required|exists:stages,id',
			'gradeId' => 'required|exists:grades,id',
		];
	}
	public function messages()
	{
		return [
			'titleEn.required' => trans('fee.NameEnRequired'),
			'titleAR.required' => trans('fee.NameArRequired'),
			'stageId.required' => trans('fee.stageRequired'),
			'gradeId.required' => trans('fee.gradeRequired'),
			'year.required' => trans('fee.yearRequired'),
			'feeType.required' => trans('fee.typeRequired'),
			'stageId.exists' => trans('fee.stageExists'),
			'gradeId.exists' => trans('fee.gradeExists'),
		];
	}
}
