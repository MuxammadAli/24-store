<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductRegionRequest;
use App\Http\Requests\Api\Product\ProductStoreRequest;
use App\Http\Requests\Api\Product\ProductUpdateRequest;
use App\Http\Resources\Api\Category\CategoryResource;
use App\Jobs\Api\Product\ProductStoreJob;
use App\Jobs\Api\Product\ProductUpdateJob;
use App\Jobs\Api\Product\RegionAttachJob;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Region;
use App\Models\Unit;
use Http\Client\Exception\HttpException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereHas('categories')->with('screens:path,path_thumb,product_id')->get();
        $products->map(function (Product $product) {
            $product->category_id = $product->categories[0]->id;
            $product->makeHidden('categories', 'images');
        });
        return $products;
    }

    /**
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $req): \Illuminate\Http\JsonResponse
    {
        $categories = Category::orderBy('name->ru', 'asc')
            ->where('parent_id', null)
            ->get();
        $brands = Brand::orderBy('name->ru', 'asc')->select('id', 'name->ru as title')->get();
        $units = Unit::orderBy('name->ru', 'asc')->select('id', 'name->ru as title')->get();
        return response()->json([
            'categories' => CategoryResource::collection($categories),
            'brands' => $brands,
            'units' => $units
        ]);
    }

    /**
     * @param ProductStoreRequest $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductStoreRequest $req): \Illuminate\Http\JsonResponse
    {
        $product = $this->dispatchNow(ProductStoreJob::fromRequest($req));
        $product->categories()->attach($req->getCategoryID());
        return response()->json(['status' => true, 'product_id' => $product->id]);
    }

    /**
     * @param ProductUpdateRequest $req
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductUpdateRequest $req, $product): \Illuminate\Http\JsonResponse
    {
        if ($req->input('type') == 'warehouse') $product = Product::find($product);
        elseif ($req->input('type') == 'supplier') $product = Product::where('productable_id', '=', $product)->first();
        $this->dispatchNow(new ProductUpdateJob($product, $req));
        return response()->json(['status' => true]);
    }

    /**
     * @param ProductRegionRequest $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function storeRegion(ProductRegionRequest $req)
    {
        if ($req->input('type') != 'supplier') {
            if (!Region::where('region_id', '=', $req->input('region'))->first())
                return response(['status' => false, 'message' => 'region is not found'], 404);
            if (!Product::find($req->input('product')))
                return response(['status' => false, 'message' => 'product is not found'], 404);
        } else {
            if (!Region::where('id', '=', $req->input('region'))->first())
                return response(['status' => false, 'message' => 'region is not found'], 404);
            if (!Product::where('productable_id', '=', $req->input('product')))
                return response(['status' => false, 'message' => 'product is not found'], 404);
        }
        try {
            $this->dispatchNow(new RegionAttachJob($req));
        } catch (HttpException $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], $exception->getCode());
        }
        return response(['status' => true], 201);
    }

    /**
     * @param ProductRegionRequest $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateRegion(ProductRegionRequest $req)
    {
        try {
            if ($req->input('type') == 'supplier') {
                Product::where('productable_id', '=', $req->input('product'))
                    ->first()
                    ->regions()
                    ->detach(
                        Region::where('id', $req->input('region'))
                            ->first()
                            ->id
                    );
            } else {
                Product::find($req->input('product'))
                    ->regions()
                    ->detach(
                        Region::where('region_id', $req->input('region'))
                            ->first()
                            ->id
                    );
            }
            $this->dispatchNow(new RegionAttachJob($req));
        } catch (HttpException $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], $exception->getCode());
        }
        return response(['status' => true]);
    }

    /**
     * @param $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete($product)
    {
        $product = Product::where('productable_id', $product)->first();
        $product->delete();
        return response(['status' => true]);
    }
}
