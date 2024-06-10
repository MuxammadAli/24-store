<?php


namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Favorites\Request as FavoriteRequest;
use App\Models\Currency;
use App\Models\Product;

class FavoriteController extends Controller
{

    protected $products;
    protected $currency;

    /**
     * Controller constructor.
     * @param Product $product
     * @param Currency $currency
     */
    public function __construct(Product $product, Currency $currency)
    {
        $this->products = $product;
        $this->currency = $currency->latest('id', 'desc')->limit(1)->first();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $favorites = auth()->user()->products()->published()->with([
            'categories' => function ($category) {
                return $category->select('id', 'name');
            },
            'brand:id,name',
            'screen:id,product_id,path,path_thumb',
            'unit'
        ])->paginate(12);

        $favorites->makeHidden([
            'created_at', 'updated_at', 'deleted_at', 'published', 'slug',
            'sizes', 'color_id', 'brand_id', 'body', 'pivot'
        ]);

        return view('site.favorites.index', compact('favorites'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Product $product)
    {
        auth()->user()->products()->syncWithoutDetaching([$product->id]);

        return response()->json([
            'status' => true
        ]);
    }


    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Product $product)
    {
        auth()->user()->products()->detach([$product->id]);

        return response()->json([
            'status' => true
        ]);
    }
}
