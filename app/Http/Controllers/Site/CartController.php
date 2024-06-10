<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Helpers\Cart;
use App\Models\Cart as Model;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\Site\Cart\CartStoreRequest;

class CartController extends Controller
{

    protected $cart;
    protected $currency;

    public function __construct(Currency $currency)
    {
        $this->cart = new Cart();
        $this->currency = $currency->latest('id', 'desc')->limit(1)->first();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        list($prices, $cart) = $this->cart->getProducts();
        $setting = Setting::first();
//        $on_credit = $setting->on_credit;
        return view('site.cart.index', compact('cart', 'prices'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function basketCount()
    {
        $count = $this->cart->getBasketCount();

        return response()->json([
            'status' => true,
            'basket' => !empty($count) ? $count : 0
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function preview()
    {
        list($prices, $cart) = $this->cart->getProducts();
        $setting = Setting::first();

        return response()->json([
            'status' => true,
            'products' => $cart,
            'prices' => $prices
        ]);
    }

    /**
     * @param CartStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CartStoreRequest $request)
    {
        $product = Product::find($request->product_id);
        $region = $product->getRegion();
        if ($region->pivot->count >= $request->count) {
            $count = $region->pivot->count - $request->count;
            $region->pivot->count = $count;
            $region->pivot->save();
            $product->save();
            $count = $this->cart->store($request);

            return response()->json([
                'status' => true,
                'count' => $count
            ]);
        } else {
            return response()->json([
                'status' => false,
                'count' => auth()->check() ? auth()->user()->cart()->whereHas('product')->count() : 0
            ]);
        }
    }

    /**
     * @param $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($product)
    {
        $count = $this->cart->delete($product);
        list($prices, $cart) = $this->cart->getProducts();

        return response()->json([
            'status' => true,
            'count' => $count,
            'prices' => $prices
        ]);
    }


    public function removeAll()
    {
        $this->cart->removeAll();

        return response()->json([
            'status' => true,
            'count' => 0,
            'prices' => 0
        ]);
    }

    /**
     * @param CartStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CartStoreRequest $request)
    {
        list($price, $count, $max_count) = $this->cart->update($request);

        return response()->json([
            'status' => true,
            'count' => $count,
            'prices' => $price,
            'max_count' => $max_count
        ]);
    }
}
