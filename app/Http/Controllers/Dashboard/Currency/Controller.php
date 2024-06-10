<?php

namespace App\Http\Controllers\Dashboard\Currency;

use App\Http\Controllers\Controller as ExController;
use App\Models\Currency;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\Currency\Store as StoreRequest;
use App\Jobs\Dashboard\Currency\Store as StoreJob;

class Controller extends ExController
{
    protected $currency;

    /**
     * Controller constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', 'currencies');
        $currencies = $this->currency->latest('id', 'desc')->limit(20)->get();
        return view('dashboard.currency.index', compact('currencies'));
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'compilations');
            return view('dashboard.currency.store');
        }

        $this->dispatchNow(StoreJob::fromRequest($request));
        $this->success(trans('admin.messages.updated'));

        return redirect()->route('dashboard.currency');
    }

}
