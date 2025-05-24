<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceReportSearch extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required| date | date_format:Y-m-d',
            'end_date' => 'required| date | date_format:Y-m-d| after_or_equal:start_date',
        ];
    }
    public function messages()
    {
        return [
            'start_date.required' => trans('attendance.startDateRequired'),
            'start_date.date' => trans('attendance.startDateIsDate'),
            'start_date.date_format' => trans('attendance.startDateIsDateFormat'),
            'end_date.required' => trans('attendance.endDateRequired'),
            'end_date.date' => trans('attendance.endDateIsDate'),
            'end_date.date_format' => trans('attendance.endDateIsDateFormat'),
        ];
    }
}
