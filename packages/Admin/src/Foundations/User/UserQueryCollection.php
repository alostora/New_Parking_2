<?php

namespace Admin\Foundations\User;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;
use Carbon\Carbon;

class UserQueryCollection
{
    public static function searchAllUsers(
        $user_account_type_id = -1,
        $query_string = -1,
        $active = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return User::where(function ($q) use (
            $user_account_type_id,
            $query_string,
            $active,
            $date_from,
            $date_to,
        ) {

            if ($user_account_type_id && $user_account_type_id != -1) {

                $q
                    ->where('user_account_type_id', $user_account_type_id);
            } else {
                $q
                    ->where('user_account_type_id', AccountTypeCollection::admin()->id)
                    ->orWhere('user_account_type_id', AccountTypeCollection::root()->id);
            }

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%')

                    ->orWhere('email', 'like', '%' . $query_string . '%');
            }

            if ($active == 'active') {

                $q
                    ->where('stopped_at', null);
            } elseif ($active == 'inactive') {

                $q
                    ->where('stopped_at', '!=', null);
            }

            if ($date_from && $date_from != -1 && $date_to && $date_to != -1) {
                $q
                    ->whereBetween('created_at', [
                        Carbon::create($date_from),
                        Carbon::create($date_to)->endOfDay(),
                    ]);
            } elseif ($date_from && $date_from != -1) {
                $q
                    ->whereBetween('created_at', [
                        Carbon::create($date_from)->startOfDay(),
                        Carbon::create(3000, 01, 01),
                    ]);
            } elseif ($date_from && $date_from != -1) {
                $q
                    ->whereBetween('created_at', [
                        Carbon::create(1900, 01, 01),
                        Carbon::create($date_to)->endOfDay(),
                    ]);
            }
        })
            ->orderBy('created_at', $sort);
    }
}
