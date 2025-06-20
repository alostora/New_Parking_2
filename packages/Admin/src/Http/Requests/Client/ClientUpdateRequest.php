<?php

namespace Admin\Http\Requests\Client;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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

            "name" => ["nullable", "string", "max:255"],

            "phone" => [
                "nullable",
                "string",
                "max:255",

                Rule::unique('users', 'phone')->ignore($request->user->id, 'id')
            ],

            "email" => [
                "nullable",
                "string",
                "max:255",

                Rule::unique('users', 'email')->ignore($request->user->id, 'id')
            ],

            "password" => ["nullable", "string", "max:255"],

            "available_customer_count" => ["bail", "required", "integer", "max:1000"],

            /* "voucher_valid_hours" => ["bail", "required", "integer", "min:1", "max:24"], */

            "address" => ["nullable", "string", "max:255"],

            "country_id" => [

                "required",
                "uuid",
                "string",

                Rule::exists('countries', 'id')->where('type', CountryType::COUNTRY['code'])
            ],

            "governorate_id" => [

                "required",
                "uuid",
                "string",

                Rule::exists('countries', 'id')->where('type', CountryType::GOVERNORATE['code'])
            ],

            "garage_id" => [
                "required",
                "uuid",
                "string",
                Rule::exists('garages', 'id')
            ],

            'file' => ['nullable', 'file'],
        ];
    }
}
