<?php

namespace App\Http\Controllers;

use App\Constants\HasLookupType\LookupType;
use App\Constants\StatusCode;
use App\Http\Requests\FinalClientCreateRequest;
use App\Http\Resources\SystemLookupResource;
use App\Models\FinalClient;
use App\Models\SystemLookup;

class GuestController extends Controller
{
    public function guestForm()
    {
        return view('Guest.createForm');
    }

    public function store(FinalClientCreateRequest $request)
    {
        return $request->validated();

        FinalClient::create($request->validated());

        return view('Guest.createForm');
    }
}
