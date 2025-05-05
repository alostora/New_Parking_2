<?php

namespace Admin\Foundations\Garage;

use App\Constants\SystemDefault;
use App\Models\Garage;

class GarageSearchCollection
{
    public static function searchGarages(
        $country_id = -1,
        $governorate_id = -1,
        $type_id = -1,
        $query_string = -1,
        $site_number = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['garages'] = GarageQueryCollection::searchAllGarages(
            $country_id,
            $governorate_id,
            $type_id,
            $query_string,
            $site_number,
            $active,
            $sort,
        )->paginate($per_page);

        $data['count_active'] = Garage::where('stopped_at', null)->count();

        $data['count_inactive'] = Garage::where('stopped_at', '!=', null)->count();

        return $data;
    }
}
