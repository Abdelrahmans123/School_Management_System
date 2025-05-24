<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'email'=>'required|email|unique:teachers,email,' . $this->id,
            'password'=>'required|min:8',
            'nameEn'=>'required',
            'nameAr'=>'required',
            'specializeId'=>'required|exists:specializations,id',
            'genderId'=>'required|exists:genders,id',
            'joinDate'=>'required|date',
            'address'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => trans('teacher.emailRequired'),
            'email.email' => trans('teacher.isEmail'),
            'password.required' => trans('teacher.passwordRequired'),
            'nameEn.required' => trans('teacher.NameEnRequired'),
            'nameAr.required' => trans('teacher.NameArRequired'),
            'specializeId.required'=>trans('teacher.specializeRequired'),
            'specializeId.exists'=>trans('teacher.specializeExists'),
            'genderId.required'=>trans('teacher.genderRequired'),
            'genderId.exists'=>trans('teacher.genderExists'),
            'joinDate.required'=>trans('teacher.joinDateRequired'),
            'joinDate.date'=>trans('teacher.joinDateNotDate'),
            'address.required' => trans('teacher.addressRequired'),
        ];
    }
}
