<?php

namespace Admin\Http\Requests\Garage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GarageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
    public function rules(Request $request): array
    {

        return [

            "name" => ["bail", "required", "string", "max:255"],

            "name_ar" => ["bail", "required", "string", "max:255"],

            "site_number" => [
                "bail",
                "required",
                "string",
                "max:7",
                "min:7",
                Rule::unique('garages', 'site_number')->ignore($request->garage->site_number, 'site_number')
            ],

            "voucher_valid_hours" => ["bail", "required", "integer", "min:1", "max:24"],
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
