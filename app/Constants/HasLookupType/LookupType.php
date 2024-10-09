<?php

namespace App\Constants\HasLookupType;

class LookupType
{
    public const LOOKUP_TYPES = [

        1 => "UserAccountType",
        2 => "CountryType",
        3 => "AllowedLanguages",
    ];

    const UserAccountType = 1;
    const CountryType = 2;
    const AllowedLanguages = 3;
}
