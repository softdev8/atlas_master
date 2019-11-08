<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CandidateSave extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'forename'          => 'required|string|max:255',
            'surname'           => 'required|string|max:255',
            'email'             => 'required|string|max:255',
            'firm_id'           => 'required|int',
            'pqe'               => 'required|string|max:255',
            'admitted_date'     => 'required|date_format:Y-m-d',
            'ref_num'           => 'required|string|max:255',
            'workphone'         => 'required|string|max:255',
            'mobile_phone'      => 'required|string|max:255',
            'website'           => 'required|string|max:255',
            'linked_in'         => 'required|string|max:255',
            'job_title'         => 'required|string|max:255',
            'gender'            => 'required|string|max:255',
            'law_society_link'  => 'required|string|max:255',
            'changed_job_date'  => 'required|date_format:Y-m-d',
            'school'            => 'required|string|max:255',
            'university'        => 'required|string|max:255',
        ];
    }
}
