<?php

namespace Client\Http\Controllers;

use Admin\Foundations\Client\ClientSearchCollection;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FinalClientController extends Controller
{


    public function index(Request $request)
    {
        $data = ClientSearchCollection::searchFinalClient(
            auth()->user(),
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/FinalClient/index', $data);
    }
}
