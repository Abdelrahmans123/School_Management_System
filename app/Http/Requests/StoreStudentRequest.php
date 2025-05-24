<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
        $studentId = $this->input('studentId');
        return [
            'email' => 'required|email|unique:students,email,' . $studentId,
            'password'=>'required|min:8',
            'nameEn'=>'required',
            'nameAr'=>'required',
            'gendersId'=>'required|exists:genders,id',
            'nationalityId'=>'required|exists:nationality,id',
            'bloodTypeId'=>'required|exists:blood_types,id',
            'birthDate'=>'required|date|date_format:Y-m-d',
            'stageId'=>'required|exists:stages,id',
            'gradeId'=>'required|exists:grades,id',
            'sectionId'=>'required|exists:sections,id',
            'parentId'=>'required|exists:guardians,id',
            'academicYear'=>'required',
            'images*' => 'required|file',

        ];
    }
    public function messages()
    {
        return [
            'email.required' => trans('teacher.emailRequired'),
            'email.email' => trans('teacher.isEmail'),
            'password.required' => trans('teacher.passwordRequired'),
            'password.min'=>trans('student.passwordMin'),
            'nameEn.required'=>trans('student.nameEnRequired'),
            'nameAr.required'=>trans('student.nameArRequired'),
            'gendersId.required'=>trans('teacher.genderRequired'),
            'gendersId.exists'=>trans('teacher.genderExists'),
            'nationalityId.required'=>trans('student.nationalityIdRequired'),
            'nationalityId.exists'=>trans('student.nationalityIdExists'),
            'stageId.required'=>trans('section.stageRequired'),
            'gradeId.required'=>trans('section.gradeRequired'),
            'stageId.exists'=>trans('section.stageExists'),
            'gradeId.exists'=>trans('section.gradeExists'),
            'bloodTypeId.exists'=>trans('student.bloodTypeExists'),
            'bloodTypeId.required'=>trans('student.bloodTypeRequired'),
            'sectionId.required'=>trans('student.sectionRequired'),
            'parentId.required'=>trans('student.parentRequired'),
            'sectionId.exists'=>trans('student.sectionExists'),
            'parentId.exists'=>trans('student.parentExists'),
            'birthDate.required'=>trans('student.birthDateRequired'),
            'birthDate.date'=>trans('student.birthDateNotDate'),
            'academicYear'=>trans('student.academicYearRequired')
        ];
    }
}
