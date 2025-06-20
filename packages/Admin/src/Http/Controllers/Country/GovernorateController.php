<?php

namespace Admin\Http\Controllers\Country;

use Admin\Foundations\Country\Governorate\GovernorateCreateCollection;
use Admin\Foundations\Country\Governorate\GovernorateSearchCollection;
use Admin\Http\Requests\Country\GovernorateCreateRequest;
use Admin\Http\Requests\Country\GovernorateUpdateRequest;
use Admin\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use App\Constants\HasLookupType\CountryType;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as Governorate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $data = GovernorateSearchCollection::searchCountryGovernorates(
            $country,
            -1,
            -1,
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Governorate/index', $data);
    }

    public function search(Country $country, Request $request)
    {
        $data = GovernorateSearchCollection::searchCountryGovernorates(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('active') ?? -1,
            $request->get('date_from') ?? -1,
            $request->get('date_to') ?? -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Governorate/index', $data);
    }

    public function searchAll(Request $request)
    {
        $data = GovernorateSearchCollection::searchAllGovernorates(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('active') ?? -1,
            $request->get('date_from') ?? -1,
            $request->get('date_to') ?? -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Governorate/index', $data);
    }

    public function countryGovernorates(Country $country)
    {
        return response()->success(
            trans('governorate.governorate_updated_successfully'),
            GovernorateMinifiedResource::collection($country->governorates),
            StatusCode::OK
        );
    }

    public function show(Governorate $governorate)
    {
        return response()->success(
            trans('governorate.governorate_retrieved_successfully'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }

    public function create()
    {
        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])->get();
        return view('Admin/Governorate/create', $data);
    }

    public function store(GovernorateCreateRequest $request)
    {
        $governorate =  GovernorateCreateCollection::createGovernorate($request->validated());

        return redirect(url('admin/governorates/' . $governorate->country_id));
    }

    public function edit(Governorate $governorate)
    {
        return view('Admin/Governorate/edit', compact('governorate'));
    }

    public function update(GovernorateUpdateRequest $request, Governorate $governorate)
    {
        $governorate->update($request->validated());

        return redirect(url('admin/governorates/' . $governorate->country_id));
    }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();

        return back();
    }

    public function active(Governorate $governorate)
    {
        $governorate->update(['stopped_at' => null]);

        return back();
    }

    public function inactive(Governorate $governorate)
    {
        $governorate->update(['stopped_at' => Carbon::now()]);

        return back();
    }
}
