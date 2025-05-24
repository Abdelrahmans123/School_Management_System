<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeInvoiceRequest extends FormRequest
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
			'feesList' => 'required|array',
			'feesList.*.amount' => 'required|numeric|min:0',
			'feesList.*.feeType' => 'required|exists:fees,id',
			'feesList.*.studentId' => 'required|exists:students,id',
			'stageId' => 'required|exists:stages,id',
			'gradeId' => 'required|exists:grades,id',
		];
	}
	public function messages()
	{
		return [
			'feesList.*.amount.required' => trans('invoice.amountRequired'),
			'feesList.*.feeType.required' => trans('invoice.feeTypeRequired'),
			'feesList.*.studentId.required' => trans('invoice.studentIdRequired'),
			'stageId.required' => trans('section.stageRequired'),
			'gradeId.required' => trans('section.gradeRequired'),
			'stageId.exists' => trans('fee.stageExists'),
			'gradeId.exists' => trans('fee.gradeExists'),
			// Add other custom messages as needed
		];
	}
}
