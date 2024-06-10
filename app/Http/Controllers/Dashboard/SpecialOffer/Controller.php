<?php

namespace App\Http\Controllers\Dashboard\SpecialOffer;

use App\Models\SpecialOffer;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\SpecialOffer\Update as UpdateRequest;
use App\Http\Requests\Dashboard\SpecialOffer\Store as StoreRequest;

use App\Jobs\Dashboard\SpecialOffer\Store as StoreJob;
use App\Jobs\Dashboard\SpecialOffer\Update as UpdateJob;

class Controller extends ExController
{

    protected $specialOffers;

    /**
     * Controller constructor.
     * @param SpecialOffer $specialOffer
     */
    public function __construct(SpecialOffer $specialOffer)
    {
        $this->specialOffers = $specialOffer;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', 'special-offers');
        $specialOffers = $this->specialOffers->latest('id')->paginate(20);
        return view('dashboard.specialOffers.index', compact('specialOffers'));
    }

    /**
     * @param UpdateRequest $request
     * @param SpecialOffer $specialOffer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(UpdateRequest $request, SpecialOffer $specialOffer)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'special-offers');
            return view('dashboard.specialOffers.update', compact('specialOffer'));
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/specialOffers');
        } else {
            $path = $specialOffer->getImage();
        }

        $this->dispatchNow(UpdateJob::fromRequest($specialOffer, $request, $path));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.specialOffers');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'special-offers');
            return view('dashboard.specialOffers.store');
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/specialOffers');
        }

        $this->dispatchNow(StoreJob::fromRequest($request, $path));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.specialOffers');
    }

    /**
     * @param SpecialOffer $specialOffer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(SpecialOffer $specialOffer)
    {
        $this->authorize('delete', 'special-offers');

        if (is_file($specialOffer->image)) {
            unlink($specialOffer->image);
        }

        $specialOffer->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
