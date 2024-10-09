<?php

namespace App\Http\Controllers;

use App\Constants\HasLookupType\LookupType;
use App\Constants\StatusCode;
use App\Http\Resources\SystemLookupResource;
use App\Models\SystemLookup;

class GuestController extends Controller
{
    public function guestForm($type)
    {
        return view('Guest.createForm');
    }
}
