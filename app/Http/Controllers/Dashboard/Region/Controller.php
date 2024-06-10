<?php

namespace App\Http\Controllers\Dashboard\Region;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Region\Update as UpdateRequest;
use App\Http\Requests\Dashboard\Region\Store as StoreRequest;

use App\Jobs\Dashboard\Region\Store as StoreJob;
use App\Jobs\Dashboard\Region\Update as UpdateJob;
use Illuminate\Support\Facades\Http;

class Controller extends ExController
{

    protected $regions;

    /**
     * Controller constructor.
     * @param Region $region
     */
    public function __construct(Region $region)
    {
        $this->regions = $region;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'regions');
        $regions = $this->regions->paginate(20);
        return view('dashboard.regions.index', compact('regions'));
    }

    /**
     * @param UpdateRequest $request
     * @param Region $region
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Region $region)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'regions');
            return view('dashboard.regions.update', compact('region'));
        }

        Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
            ->patch(env('WAREHOUSE_URL') . 'api/region/edit/'. $region->region_id, [
                'name' => $request->getName(),
                'cash' => $request->getCash()
            ]);
        $this->dispatchNow(UpdateJob::fromRequest($region, $request));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.regions');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'regions');
            return view('dashboard.regions.store');
        }
        $response = Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
            ->post(env('WAREHOUSE_URL') . 'api/region/create', [
                'name' => $request->getName(),
                'cash' => $request->getCash()
            ]);
        $region_id = $response->object()->id;
        $this->dispatchNow(StoreJob::fromRequest($request, $region_id));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.regions');
    }

    /**
     * @param Region $region
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Region $region)
    {
        $this->authorize('delete', 'regions');
        $region->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
