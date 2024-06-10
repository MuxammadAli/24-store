<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Models\Region;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Setting\Update as UpdateRequest;
use App\Jobs\Dashboard\Setting\Update as UpdateJob;

class Controller extends ExController
{
    protected $setting;

    /**
     * Controller constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting->first();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('update', 'settings');
        $setting = $this->setting;
        $regions = Region::orderBy('id', 'desc')->get();
        return view('dashboard.settings.index', compact('setting', 'regions'));
    }

    /**
     * @param UpdateRequest $request
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Setting $setting)
    {
        $this->dispatchNow(UpdateJob::fromRequest($this->setting, $request));
        $this->info(trans('admin.messages.updated'));
        return redirect()->back();
    }

    public function delivery(Request $request)
    {
//        $this->authorize('delivery', 'settings');
        Gate::check('update', 'settings');
        $setting = $this->setting;

        if ($request->isMethod('get')) {
            return view('dashboard.settings.delivery', compact('setting'));
        }

        $pickup = $request->pickup == 1 ? true : false;
        $delivery = $request->delivery == 1 ? true : false;

        $setting->update([
            'price_delivery' => $request->price_delivery,
            'pickup' => $pickup,
            'delivery' => $delivery,
            'day_delivery' => $request->day_delivery,
            'pickup_text' => $request->pickup_text,
            'other' => $request->other
        ]);

        $this->info(trans('admin.messages.updated'));
        return redirect()->back();

    }
}
