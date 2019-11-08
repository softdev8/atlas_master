<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProjectUpdateRequest extends FormRequest
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
            'id'                     => 'required|int',
            'title'                  => 'required|string',
            'last_open'              => 'required|date_format:Y-m-d H:i:s',
            'user'                   => 'required|int',
            'firms'                  => 'present|array',
            'regions'                => 'present|array',
            'filters.area'           => 'required|int',
            'filters.specialisms'    => 'present|array',
            'filters.subspecialisms' => 'present|array',
            'filters.levels'         => 'present|array',
            'filters.types'          => 'present|array',
            'candidates'             => 'present|array',
        ];
    }

    /**
     * Changing the response structure
     *
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(ResponseService::output(['errors' => $validator->errors()]), 400));
    }
}
