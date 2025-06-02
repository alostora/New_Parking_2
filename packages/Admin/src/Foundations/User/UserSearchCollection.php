<?php

namespace Admin\Foundations\User;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class UserSearchCollection
{
    public static function searchUsers(
        $user_account_type_id = -1,
        $query_string = -1,
        $active = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['users'] = UserQueryCollection::searchAllUsers(
            $user_account_type_id,
            $query_string,
            $active,
            $date_from,
            $date_to,
            $sort,
        )->paginate($per_page);

        $data['user_account_types'] = AccountTypeCollection::admin();

        $data['count_active'] = User::where('stopped_at', null)
            ->whereIn('user_account_type_id', [
                AccountTypeCollection::admin()->id,
                AccountTypeCollection::root()->id
            ])->count();

        $data['count_inactive'] = User::where('stopped_at', '!=', null)
            ->whereIn('user_account_type_id', [
                AccountTypeCollection::admin()->id,
                AccountTypeCollection::root()->id
            ])->count();

        return $data;
    }
}
