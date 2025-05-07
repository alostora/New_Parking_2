<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
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


        $lastIncrementalNumber = FinalClient::where('client_id', $validated['client_id'])->latest()->first();

        $nextNumber = $lastIncrementalNumber ? (int)$lastIncrementalNumber->final_cliend_incremental_number + 1 : 1;

        $validated['final_cliend_incremental_number'] = $nextNumber;

        $validated['guest_id'] = self::createSesstionGuestId();


        $finalClient = FinalClient::create($validated);

        return redirect(url('guest/final-client/qr-generator/' . $finalClient->id));
    }


    public static function createSesstionGuestId()
    {
        if (!Session::has('guest_id')) {
            Session::put('guest_id', Str::random(50));

            // Optional: Make the session permanent (until browser closes)
            Session::save();
        }

        // Retrieve the guest ID
        return Session::get('guest_id');
    }

    public function QrGenerator(FinalClient $finalClient)
    {
        $data['finalClient'] = $finalClient;

        return view('Guest.QrGenerator.qrGenerator', $data);
    }
}
