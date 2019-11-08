<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReportGetRequest extends FormRequest
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
            'user_id'       => 'required|int',
            'candidate_id'  => 'required|int',
            'description'   => 'required|string',
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
