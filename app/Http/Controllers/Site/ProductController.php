<?php


namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Setting;

use Illuminate\Http\Request;
use App\Http\Requests\Site\Product\BuyOneClickRequest;

use App\Helpers\Product as Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;


class ProductController extends Controller
{

    protected $setting;
    protected $helper;

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->setting = Setting::find(1);
        $this->helper = new Helper();
    }

    /**
     * @param Product $product
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product, $slug)
    {
        $setting = $this->setting;
        list($product, $category) = $this->helper->getProductShowAttributes($product);
        $popularProducts = $this->helper->getPopularProducts($product);
        [$product->price, $product->price_discount] = $product->getRegionPrice();
        $product->count = $product->getCount();

        return view('site.product.show', compact('product', 'popularProducts', 'category', 'setting'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
//        if ($request->isMethod('post')) {
            $products = $this->helper->getSearchProduct($request->name, $request->post('order_by') ?? null);
//        } else {
//            $products = $this->helper->getSearchProduct($request->name, null);
//        }

        if ($request->ajax()) {
            return response()->json($products);
        }

        return view('site.search', compact('products'));
    }
}
