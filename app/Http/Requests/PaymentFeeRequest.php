<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentFeeRequest extends FormRequest
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
