<?php

namespace App\Http\Controllers;

use App\Constants\HasLookupType\UserAccountType;

class DashboardController extends Controller
{
    public function index()
    {
        if (
            in_array(auth()->user()->accountType->code, [UserAccountType::ADMIN['code'], UserAccountType::ROOT['code']])
        ) {
            return view('Admin/dashboard');
        } elseif (in_array(auth()->user()->accountType->code, [UserAccountType::CLIENT['code']])) {
            return view('Client/dashboard');
        }
    }
}
