<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FinalClientCreateRequest;
use App\Models\AvailableFinalClientPackage;
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

        $validated['garage_id'] = User::find($validated['client_id'])->garage_id;

        //nextFinalClientNumber
        $finalClient = FinalClient::where('client_id', $validated['client_id'])->latest()->first();
        $nextFinalClientNumber = $finalClient ? (int)$finalClient->final_cliend_incremental_number + 1 : 1;
        $validated['final_cliend_incremental_number'] = $nextFinalClientNumber;

        //nextAvailableFinalClientPackageNumber
        $availableFinalClientPackage = AvailableFinalClientPackage::where('client_id', $validated['client_id'])->latest()->first();
        $nextAvailableFinalClientPackageNumber = $availableFinalClientPackage ? (int)$availableFinalClientPackage->final_cliend_number_of_usage + 1 : 1;
        $availableFinalClientPackage->update(['final_cliend_number_of_usage' => $nextAvailableFinalClientPackageNumber]);

        //geenrateGuestId
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
