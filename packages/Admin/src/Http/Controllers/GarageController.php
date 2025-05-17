<?php

namespace Admin\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Garage;
use Admin\Foundations\Garage\GarageSearchCollection;
use Admin\Http\Requests\Garage\GarageCreateRequest;
use Admin\Http\Requests\Garage\GarageUpdateRequest;
use Admin\Http\Resources\Garage\GarageResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GarageController extends Controller
{
    public function index(Request $request)
    {
        $data = GarageSearchCollection::searchGarages(
            -1,
            -1,
            -1,
            -1,
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Garage/index', $data);
    }

    public function search(Request $request)
    {
        $data = GarageSearchCollection::searchGarages(
            $request->get('country_id') ? $request->get('country_id') : -1,
            $request->get('governorate_id') ? $request->get('governorate_id') : -1,
            $request->get('type_id') ? $request->get('type_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('site_number') ? $request->get('site_number') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Garage/index', $data);
    }

    // public function show(Garage $garage)
    // {
    //     return response()->success(
    //         trans('general.retrieved'),
    //         new GarageResource($garage),
    //         StatusCode::OK
    //     );
    // }

    public function create()
    {
        return view('Admin/Garage/create');
    }

    public function store(GarageCreateRequest $request)
    {
        $garage = Garage::create($request->validated());

        return redirect(url('admin/garages'));
    }

    public function edit(Garage $garage)
    {
        $data['garage'] = $garage;

        return view('Admin/Garage/edit', $data);
    }

    public function update(GarageUpdateRequest $request, Garage $garage)
    {
        $garage->update($request->validated());

        return redirect(url('admin/garages'));
    }

    public function destroy(Garage $garage)
    {
        $garage->delete();

        return back();
    }

    public function active(Garage $garage)
    {
        $garage->update(['stopped_at' => null]);

        return back();
    }

    public function inactive(Garage $garage)
    {
        $garage->update(['stopped_at' => Carbon::now()]);

        return back();
    }
}
