<?php

namespace App\Constants\HasLookupType;

class UserAccountType
{
    public const LOOKUP_TYPE = 1;

    public const TYPE_LIST = [
        1 => self::ROOT,
        2 => self::ADMIN,
        3 => self::CLIENT,
    ];

    public const ROOT = [
        'code' => 1,
        'key' => 1,
        'prefix' => "AUDITOR",
        'name' => "Auditor",
        'name_ar' => "مراجع",
    ];

    public const ADMIN = [
        'code' => 2,
        'key' => 2,
        'prefix' => "ADMIN",
        'name' => "Admin",
        'name_ar' => "مدير",
    ];

    public const CLIENT = [
        'code' => 3,
        'key' => 3,
        'prefix' => "CLIENT",
        'name' => "Client",
        'name_ar' => "عميل",
    ];
}
