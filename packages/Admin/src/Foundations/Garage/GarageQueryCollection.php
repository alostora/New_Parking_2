<?php

namespace Admin\Foundations\Garage;

use App\Constants\SystemDefault;
use App\Models\Garage;
use Carbon\Carbon;

class GarageQueryCollection
{
    public static function searchAllGarages(
        $country_id = -1,
        $governorate_id = -1,
        $type_id = -1,
        $query_string = -1,
        $site_number = -1,
        $active = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return Garage::where(function ($q) use (
            $type_id,
            $query_string,
            $site_number,
            $country_id,
            $governorate_id,
            $active,
            $date_from,
            $date_to,
        ) {

            if ($type_id && $type_id != -1) {

                $q
                    ->where('type_id', $type_id);
            }

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%')

                    ->orWhere('name_ar', 'like', '%' . $query_string . '%');
            }

            if ($site_number && $site_number != -1) {

                $q
                    ->where('site_number', $site_number);
            }

            if ($country_id && $country_id != -1) {

                $q
                    ->where('country_id', $country_id);
            }

            if ($governorate_id && $governorate_id != -1) {

                $q
                    ->where('governorate_id', $governorate_id);
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
