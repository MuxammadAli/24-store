<?php

namespace App\Http\Controllers\Dashboard\CoinProduct;

use App\Http\Controllers\Controller as ExController;
use App\Http\Requests\Dashboard\CoinProduct\CoinProductStoreRequest;
use App\Http\Requests\Dashboard\CoinProduct\CoinProductUpdateRequest;
use App\Jobs\Dashboard\CoinProduct\CoinProductStoreJob;
use App\Jobs\Dashboard\CoinProduct\CoinProductUpdateJob;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CoinProduct;
use App\Models\Unit;
use App\Jobs\Dashboard\Product\Child as ScreenStoreJob;
use App\Jobs\Dashboard\Product\ChildUpdate as ScreenUpdateJob;
use Illuminate\Http\Request;

class Controller extends ExController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (request()->get('direction') === 'asc') $direction = 'desc';
        else $direction = 'asc';
        return view('dashboard.coin-product.index', [
            'products' => CoinProduct::orderBy(request('column', 'id'), request('direction', 'desc'))->paginate(20),
            'categories' => Category::all(),
            'direction' => $direction
        ]);
    }

    /**
     * @param CoinProductStoreRequest $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function store(CoinProductStoreRequest $req)
    {
        if ($req->isMethod('get')) {
            return view('dashboard.coin-product.store', [
                'categories' => Category::select('id', 'name->ru as category')
                    ->where('parent_id', null)
                    ->with(['parents' => function ($parent) {
                        return $parent->select('id', 'name->ru as category', 'parent_id')->orderBy('category', 'asc')->with(['parents' => function ($parent) {
                            return $parent->select('id', 'name->ru as category', 'parent_id')->orderBy('category', 'asc');
                        }]);
                    }])->orderBy('category', 'asc')->get(),
            ]);
        }
        $product = $this->dispatchNow(new CoinProductStoreJob($req));
        $this->dispatchNow(new ScreenStoreJob($req, $product, 'coin'));
        $this->success(trans('admin.messages.created'));
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * @param CoinProductUpdateRequest $req
     * @param CoinProduct $coinProduct
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function update(CoinProductUpdateRequest $req, CoinProduct $coinProduct)
    {
        if ($req->isMethod('get')) {
            $coinProduct->loadMissing([
                'category' => function ($category) {
                    return $category->select('id', 'name->ru as category', 'parent_id')->with(['parent' => function ($parent) {
                        return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents', 'parent' => function ($parent) {
                            return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents' => function ($parent) {
                                return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents' => function ($parent) {
                                    return $parent->select('id', 'name->ru as category', 'parent_id');
                                }]);
                            }]);
                        }, 'parents' => function ($parent) {
                            return $parent->select('id', 'name->ru as category', 'parent_id');
                        }]);
                    }]);
                },
                'screens',
            ]);

            $coinProduct->screens->map(function ($screen) {
                $screen->sizeText = $screen->size / 1024 . 'Kb';
                $screen->url = '/' . $screen->path;
                $screen->type = "image/jpeg";
                return $screen;
            });

            return view('dashboard.coin-product.update', [
                'product' => $coinProduct,
                'categories' => Category::select('id', 'name->ru as category')
                    ->where('parent_id', null)
                    ->with(['parents' => function ($parent) {
                        return $parent->select('id', 'name->ru as category', 'parent_id')->orderBy('category', 'asc')->with(['parents' => function ($parent) {
                            return $parent->select('id', 'name->ru as category', 'parent_id')->orderBy('category', 'asc');
                        }]);
                    }])->orderBy('category', 'asc')->get(),
            ]);
        }

        $this->dispatchNow(new CoinProductUpdateJob($req, $coinProduct));
        $this->dispatchNow(new ScreenUpdateJob($req, $coinProduct, 'coin'));
        $this->success(trans('admin.messages.created'));
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $id = empty($request->get('id')) ? null : $request->get('id');
        $name = empty($request->get('name')) ? null : $request->get('name');
        $in_stock = empty($request->get('in_stock')) && $request->get('in_stock') == 0 ? null : $request->get('in_stock');
        $published = empty($request->get('published')) ? null : $request->get('published');
        $article_number = empty($request->get('article_number')) ? null : $request->get('article_number');

        if ($in_stock) {
            $products = CoinProduct::orderBy($request->get('column', 'id'), $request->get('direction', 'desc'))->searchFilter($id, $brand, $category, $published, $article_number, $category_id, $name);

            if ($in_stock == 1) {
                $products = $products->where('available', 1)->where('count', '>', 0);
            }

        } else {
            $products = CoinProduct::orderBy($request->get('column', 'id'), $request->get('direction', 'desc'))->searchFilter($id, $brand, $category, $published, $article_number, $category_id, $name);

            if ($in_stock == 0) {
                $products = $products->where('available', 0)->where('count', '>', 0)
                    ->orWhere('available', 1)->where('count', 0)->searchFilter($id, $brand, $category, $published, $category_id, $name)
                    ->orWhere('available', 0)->where('count', 0)->searchFilter($id, $brand, $category, $published, $category_id, $name);
            }
        }
        $products = $products->paginate(10);
        if ($request->get('direction') === 'asc') $direction = 'desc';
        else $direction = 'asc';
        return view('dashboard.coin-product.index', compact('products', 'direction'));
    }

    /**
     * @param CoinProduct $coinProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(CoinProduct $coinProduct): \Illuminate\Http\RedirectResponse
    {
        $coinProduct->delete();
        $this->error(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
