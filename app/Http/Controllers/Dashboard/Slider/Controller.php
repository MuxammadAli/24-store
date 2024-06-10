<?php

namespace App\Http\Controllers\Dashboard\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Slider\Update as UpdateRequest;
use App\Http\Requests\Dashboard\Slider\Store as StoreRequest;

use App\Jobs\Dashboard\Slider\Store as StoreJob;
use App\Jobs\Dashboard\Slider\Update as UpdateJob;

class Controller extends ExController
{

    protected $sliders;

    /**
     * Controller constructor.
     * @param Slider $slider
     */
    public function __construct(Slider $slider)
    {
        $this->sliders = $slider;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'sliders');
        $sliders = $this->sliders->latest('id')
                        ->paginate(20);

        return view('dashboard.sliders.index', compact('sliders'));
    }

    /**
     * @param UpdateRequest $request
     * @param Slider $slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Slider $slider)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'sliders');
            return view('dashboard.sliders.update', compact('slider'));
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/sliders');
        } else {
            $path = $slider->getImage();
        }

        $this->dispatchNow(UpdateJob::fromRequest($slider, $request, $path));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.sliders');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'sliders');
            return view('dashboard.sliders.store');
        }


        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/sliders');
        }

        $this->dispatchNow(StoreJob::fromRequest($request, $path));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.sliders');
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Slider $slider)
    {
        $this->authorize('delete', 'sliders');
        if (is_file($slider->image)) {
            unlink($slider->image);
        }

        $slider->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
