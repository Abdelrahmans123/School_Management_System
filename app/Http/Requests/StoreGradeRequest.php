<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
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
            'grades.*.gradeEn'=>'required',
            'grades.*.gradeAr'=>'required',
            'grades.*.stageId'=>'required|exists:stages,id'
        ];
    }
    public function messages()
    {
        return [
            'gradeEn.required' => trans('grade.NameEnRequired'),
            'gradeAr.required' => trans('grade.NameArRequired'),
            'stageId.required' => trans('grade.stageNameRequired'),
            'stageId.exists'=>trans('grade.stageNameExist')
        ];
    }
}
