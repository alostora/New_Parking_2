<?php

namespace App\Rules;

use App\Models\FinalClient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Session;


class ValidateFinalClientTimeRegisterPossible implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */

    public $message;

    public function passes($attribute, $value): bool
    {
        $finalClient = FinalClient::where('client_id', $value)
            ->where('guest_id', Session::get('guest_id'))
            ->latest()
            ->first();

        $customer = User::find($value);

        if ($customer->totalAvailableCustomer <= 0) {

            $this->message = "لا يمكن التسجيل لان مزود الخدمه قد اتم العدد المتاح";

            return false;
        }

        $hoursDiff = 0;

        if ($finalClient) {

            $start = Carbon::parse($finalClient->created_at);

            $end = Carbon::now();

            $hoursDiff = $start->diffInHours($end);

            if ($hoursDiff < 12) {

                $this->message = "لا يمكنك الحصول علي ساعة خصم اضافية مرة اخري قبل " . (12 - $hoursDiff) . " ساعة";

                return false;
            }
        }

        return  true;
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
