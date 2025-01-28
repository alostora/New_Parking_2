<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinalClientCreateRequest;
use App\Models\FinalClient;

class GuestController extends Controller
{
    public function guestForm()
    {
        return view('Guest.createForm');
    }

    public function store(FinalClientCreateRequest $request)
    {
        $finalClient = FinalClient::create($request->validated());

        return redirect(url('guest/final-client/qr-generator/' . $finalClient->id));
    }

    public function QrGenerator(FinalClient $finalClient)
    {
        $data['finalClient'] = $finalClient;

        return view('Guest.QrGenerator.qrGenerator', $data);
    }
}
