<?php

namespace App\Http\Controllers\Dashboard\Partner;

use App\Http\Controllers\Controller as ExController;
use App\Models\Partner;

use App\Http\Requests\Dashboard\Partner\Update as UpdateRequest;
use App\Http\Requests\Dashboard\Partner\Store as StoreRequest;

use App\Jobs\Dashboard\Partner\Store as StoreJob;
use App\Jobs\Dashboard\Partner\Update as UpdateJob;

class Controller extends ExController
{
    protected $partners;

    /**
     * Controller constructor.
     * @param Partner $partner
     */
    public function __construct(Partner $partner)
    {
        $this->partners = $partner;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', 'partners');
        $partners = $this->partners->latest('id')->paginate(20);
        return view('dashboard.partners.index', compact('partners'));
    }

    /**
     * @param UpdateRequest $request
     * @param Partner $partner
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(UpdateRequest $request, Partner $partner)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'partners');
            return view('dashboard.partners.update', compact('partner'));
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/partners');
        } else {
            $path = $partner->getImage();
        }

        $this->dispatchNow(UpdateJob::fromRequest($partner, $request, $path));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.partners');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'partners');
            return view('dashboard.partners.store');
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/partners');
        }

        $this->dispatchNow(StoreJob::fromRequest($request, $path));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.partners');
    }

    /**
     * @param Partner $partner
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Partner $partner)
    {
        $this->authorize('delete', 'partners');
        if (is_file($partner->image)) {
            unlink($partner->image);
        }

        $partner->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
