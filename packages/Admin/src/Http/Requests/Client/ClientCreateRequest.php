<?php

namespace Admin\Http\Requests\Client;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientCreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [

            "name" => ["bail", "required", "string", "max:255"],

            "email" => ["bail", "required", "email", "unique:users,email", "max:255"],

            "phone" => ["bail", "required", "string", "unique:users,phone", "max:255"],

            "password" => ["bail", "required", "string", "max:255"],

            /* "voucher_valid_hours" => ["bail", "required", "integer", "min:1", "max:24"], */

            "available_customer_count" => ["bail", "required", "integer", "max:1000"],

            "address" => ["bail", "nullable", "string", "max:255"],

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
