<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FirmLocationUpdate extends FormRequest
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
            'firm_id'    => 'required|int',
            'country_id' => 'required|int',
            'region_id'  => 'required|int',
            'city_id'    => 'nullable|int',
            'address'    => 'nullable|string|max:255',
        ];
    }
}
