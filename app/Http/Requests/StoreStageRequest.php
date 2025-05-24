<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStageRequest extends FormRequest
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

            'stageEn'=>'required|unique:stages,Name->en,'.$this->id,
            'stageAr'=>'required|unique:stages,Name->ar,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'stageEn.required' => trans('stage.NameEnRequired'),
            'stageAr.required' => trans('stage.NameArRequired'),
            'stageEn.unique'=>trans('stage.NameUnique'),
            'stageAr.unique'=>trans('stage.NameUnique'),
        ];
    }
}
