<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
			'topic' => 'required|string',
			'start_time' => 'required|date',
			'duration' => 'required|numeric|min:1',
			'stage_id' => 'required|exists:stages,id',
			'grade_id' => 'required|exists:grades,id',
			'section_id' => 'required|exists:sections,id',
		];
	}
	public function messages()
	{
		return [
			'topic.required' => trans('session.topicRequired'),
			'topic.string' => trans('session.topicString'),
			'start_time.required' => trans('session.startAtRequired'),
			'start_time.date' => trans('session.startAtDate'),
			'duration.required' => trans('session.durationRequired'),
			'duration.numeric' => trans('session.durationNumeric'),
			'duration.min' => trans('session.durationMin'),
			'stage_id.required' => trans('quiz.stageRequired'),
			'grade_id.required' => trans('quiz.gradeRequired'),
			'stage_id.exists' => trans('quiz.stageExists'),
			'grade_id.exists' => trans('quiz.gradeExists'),
			'section_id.required' => trans('quiz.sectionIdRequired'),
			'section_id.exists' => trans('quiz.sectionIdExists'),
		];
	}
}
