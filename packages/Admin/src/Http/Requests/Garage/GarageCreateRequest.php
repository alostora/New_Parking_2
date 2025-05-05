<?php

namespace Admin\Http\Requests\Garage;

use Illuminate\Foundation\Http\FormRequest;

class GarageCreateRequest extends FormRequest
{
    /**
     * Determine if the company is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [

            "site_number" => [
                "bail",
                "required",
                "string",
                "min:7",
                "max:7",
                "unique:garages,site_number"
            ],

            "name" => ["bail", "required", "string", "max:255"],

            "name_ar" => ["bail", "required", "string", "max:255"],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),

            'name_ar.required' => trans('general_validate.name_ar_is_required'),
            'name_ar.string' => trans('general_validate.name_ar_must_be_string'),

            'site_number.required' => trans('general_validate.site_number_is_required'),
            'site_number.numeric' => trans('general_validate.site_number_must_be_numeric'),
            'site_number.unique' => trans('general_validate.site_number_must_be_unique'),
        ];
    }
}
