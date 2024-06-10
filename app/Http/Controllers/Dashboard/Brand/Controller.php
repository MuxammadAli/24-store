<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Brand\Update as UpdateRequest;
use App\Http\Requests\Dashboard\Brand\Store as StoreRequest;

use App\Jobs\Dashboard\Brand\Store as StoreJob;
use App\Jobs\Dashboard\Brand\Update as UpdateJob;

class Controller extends ExController
{

    protected $brands;

    /**
     * Controller constructor.
     * @param Brend $brand
     */
    public function __construct(Brand $brand)
    {
        $this->brands = $brand;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'brands');
        $brands = $this->brands->latest('id')->paginate(20);
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * @param UpdateRequest $request
     * @param Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'brands');
            return view('dashboard.brands.update', compact('brand'));
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/brands');
        } else {
            $path = $brand->getImage();
        }

        $this->dispatchNow(UpdateJob::fromRequest($brand, $request, $path));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.brands');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'brands');
            return view('dashboard.brands.store');
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/brands');
        }

        $this->dispatchNow(StoreJob::fromRequest($request, $path));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.brands');
    }

    /**
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Brand $brand)
    {
        $this->authorize('delete', 'brands');

        if (is_file($brand->image)) {
            unlink($brand->image);
        }

        Product::where('brand_id', $brand->id)->withTrashed()->update([
            'brand_id' => null
        ]);

        $brand->delete();

        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
