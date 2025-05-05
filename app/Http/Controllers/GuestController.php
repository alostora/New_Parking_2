<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinalClientCreateRequest;
use App\Models\FinalClient;
use App\Models\User;

class GuestController extends Controller
{
    public function guestForm()
    {
        return view('Guest.createForm');
    }

    public function store(FinalClientCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['garage_id'] = User::find($validated['client_id'])->first()->garage_id;

        $finalClient = FinalClient::create($validated);

        return redirect(url('guest/final-client/qr-generator/' . $finalClient->id));
    }

    public function QrGenerator(FinalClient $finalClient)
    {
        $data['finalClient'] = $finalClient;

        return view('Guest.QrGenerator.qrGenerator', $data);
    }
}
