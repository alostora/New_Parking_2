<?php

namespace Admin\Foundations\Country;

use App\Constants\HasLookupType\CountryType;
use App\Constants\SystemDefault;
use App\Models\Country;
use Carbon\Carbon;

class CountryQueryCollection
{
    public static function searchAllCountries(
        $query_string = -1,
        $active = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return Country::where('type', CountryType::COUNTRY['code'])

            ->where(function ($q) use (
                $query_string,
                $active,
                $date_from,
                $date_to
            ) {

                if ($query_string && $query_string != -1) {

                    $q

                        ->where(function ($q) use ($query_string) {

                            $q
                                ->where('name', 'like', '%' . $query_string . '%')

                                ->orWhere('name_ar', 'like', '%' . $query_string . '%');
                        });
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
