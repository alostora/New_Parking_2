<?php

namespace Admin\Foundations\Client;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\FinalClient;
use App\Models\User;

class ClientSearchCollection
{
    public static function searchUsers(
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['users'] = ClientQueryCollection::searchAllUsers(
            $query_string,
            $active,
            $sort,
        )->paginate($per_page);

        $data['count_active'] = User::where('stopped_at', null)
            ->whereIn('user_account_type_id', [
                AccountTypeCollection::client()->id
            ])->count();

        $data['count_inactive'] = User::where('stopped_at', '!=', null)
            ->whereIn('user_account_type_id', [
                AccountTypeCollection::client()->id
            ])->count();

        return $data;
    }

    public static function searchFinalClient(
        User $user,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['final_clients'] = ClientQueryCollection::searchAllFinalClients(
            $user,
            $query_string,
            $active,
            $sort,
        )->paginate($per_page);

        $data['count_active'] = FinalClient::where('client_id', $user->id)->where('stopped_at', null)->count();

        $data['count_inactive'] = FinalClient::where('client_id', $user->id)->where('stopped_at', '!=', null)->count();

        return $data;
    }
}
