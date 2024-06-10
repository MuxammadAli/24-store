<?php

namespace App\Http\Controllers\Dashboard\City;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\City\Update as UpdateRequest;
use App\Http\Requests\Dashboard\City\Store as StoreRequest;

use App\Jobs\Dashboard\City\Store as StoreJob;
use App\Jobs\Dashboard\City\Update as UpdateJob;

class Controller extends ExController
{

    protected $cities;

    /**
     * Controller constructor.
     * @param City $city
     */
    public function __construct(City $city)
    {
        $this->cities = $city;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', 'cities');
        $cities = $this->cities->latest('id')->paginate(20);
        return view('dashboard.cities.index', compact('cities'));
    }

    /**
     * @param UpdateRequest $request
     * @param City $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(UpdateRequest $request, City $city)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'cities');
            $regions = Region::all();
            return view('dashboard.cities.update', compact('city', 'regions'));
        }

        $this->dispatchNow(UpdateJob::fromRequest($city, $request));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.cities');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'cities');
            $regions = Region::all();
            return view('dashboard.cities.store', compact('regions'));
        }

        $this->dispatchNow(StoreJob::fromRequest($request));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.cities');
    }

    /**
     * @param City $city
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(City $city)
    {
        $this->authorize('delete', 'cities');
        $city->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
