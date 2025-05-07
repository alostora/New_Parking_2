<?php

namespace App\Rules;

use App\Models\FinalClient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;


class ValidateFinalClientTimeRegisterPossible implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */

    public $name;
    public $phone;
    public $message;

    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    public function passes($attribute, $value): bool
    {
        $finalClient = FinalClient::where('client_id', $value)
            ->where('name', $this->name)
            ->where('phone', $this->phone)
            ->latest()
            ->first();

        $availableCustomerCount = User::find($value)->available_customer_count;

        $finalClientCount = FinalClient::where('client_id', $value)->count();

        if ($availableCustomerCount - $finalClientCount <= 0) {
            $this->message = "لا يمكن التسجيل لان مزود الخدمه قد اتم العدد المتاح";
        }

        $hoursDiff = 0;

        if ($finalClient) {

            $start = Carbon::parse($finalClient->created_at);

            $end = Carbon::now();

            $hoursDiff = $start->diffInHours($end);

            if ($hoursDiff < 12) {

                $this->message = "لا يمكنك التسجيل قبل " . (12 - $hoursDiff) . " ساعة";
            }
        }

        return ($hoursDiff < 12) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
