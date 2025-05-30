<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptStudentRequest extends FormRequest
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
			'amount' => 'required|numeric|min:1',
			'description' => 'required|string'
		];
	}
	public function messages()
	{
		return [
			'amount.required' => trans('invoice.amountRequired'),
			'description.required' => trans('invoice.descriptionRequired'),
		];
	}
}
