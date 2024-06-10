<?php

namespace App\Helpers;

use App\Models\Cart as Model;
use App\Models\Product;
use App\Models\Region;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Cart
{

    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private $http;

    public function __construct()
    {
        $this->http = Http::withBasicAuth(env('API_USERNAME'), env('API_USERNAME'))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]);
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken(Cookie::get('cart_token'))
                ->with('product.screen', 'product.unit')
                ->whereHas('product')
                ->get();
        } else if (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)
                ->with('product.screen', 'product.unit')
                ->whereHas('product')
                ->get();
        } else {
            $cart = collect([]);
        }

        $cart->map(function ($cart) {
            if (!empty($cart->product)) {
                $cart->product->count = $cart->product->getCount();
                [$cart->price, $cart->price_discount] = $cart->product->getRegionPrice();
            } else {
                $cart->price = 0;
                $cart->price_discount = 0;
            }
        });

        $prices = $cart->map(function ($cart) {
            $price = 0;
            $price_discount = 0;

            $price_current = 0;

            $price += $cart->price * $cart->count;
            $price_discount += $cart->price_discount * $cart->count;

            $price_current = $cart->price_discount ? $cart->price_discount * $cart->count : $cart->price * $cart->count;

            return $price_current;
        });

        $prices = array_sum($prices->toArray());

        return [$prices, $cart];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken(Cookie::get('cart_token'))->where('product_id', $request->product_id)->first();
            abort_if(!empty($cart), 400, 'Product already exists in the cart');

            Model::create([
                'product_id' => $request->product_id,
                'count' => $request->count,
                'size' => $request->getSize(),
                'token' => $request->cookie('cart_token'),
                'region_id' => Cookie::get('region')
            ]);
            $count = Model::findByToken($request->cookie('cart_token'))->whereHas('product')->count();
        } elseif (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)->where('product_id', $request->product_id)->first();

            abort_if(!empty($cart), 400, 'Product already exists in the cart');

            $product = Product::find($request->product_id);
            if ($product->productable_type == 'warehouse') {
                $url = env('WAREHOUSE_URL') . 'api/cart/add-product';
                $region_id = Region::find(auth()->user()->region_id)->region_id;
                $product_id = $request->product_id;
            } else {
                $url = env('SUPPLIERS_URL') . 'cart/store';
                $region_id = auth()->user()->region_id;
                $product_id = $product->productable_id;
            }

            Log::info('request start');
            $response = $this->http->post($url, [
                'user' => auth()->id(),
                'region' => $region_id,
                'product' => $product_id,
                'qty' => $request->count
            ]);
            Log::info('request end: ' . $response->body());
//            echo $response->body();
//            dd([
//                'user' => auth()->id(),
//                'region' => $region_id,
//                'product' => $product_id,
//                'qty' => $request->count
//            ]);

            $cart = Model::create([
                'product_id' => $request->product_id,
                'count' => $request->count,
                'size' => $request->getSize(),
                'user_id' => auth()->id(),
                'region_id' => auth()->user()->region_id
            ]);

            $count = auth()->user()->cart()->whereHas('product')->count();
        }

        return $count;
    }

    /**
     * @param $product
     * @return mixed
     */
    public function delete($product)
    {
        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken(Cookie::get('cart_token'))->where('product_id', $product)->first();
            $count = Model::findByToken(Cookie::get('cart_token'))->whereHas('product')->count();
        } elseif (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)->where('product_id', $product)->first();
            $product = Product::find($cart->product_id);

            if ($product->productable_type == 'warehouse') {
                $url = env('WAREHOUSE_URL') . 'api/cart/';
                $region_id = Region::find(auth()->user()->region_id)->region_id;
                $product = $product->id;
            } else {
                $url = env('SUPPLIERS_URL') . 'cart/';
                $region_id = auth()->user()->region_id;
                $product = $product->productable_id;
            }
            $response = $this->http->delete($url . 'remove-product', [
                'user' => auth()->id(),
                'region' => $region_id,
                'product' => $product
            ]);
            $count = auth()->user()->cart()->whereHas('product')->count();
        }

        if (!empty($cart)) {
            $region = $cart->product->getRegion();
            $region->pivot->count += $cart->count;
            $region->pivot->save();
            $cart->delete();
        }

        return $count;
    }

    /**
     *
     */
    public function removeAll()
    {
        if (Cookie::has('cart_token')) {
            $carts = Model::findByToken(Cookie::get('cart_token'))->get();
        } elseif (auth()->check()) {
            $carts = Model::findByUser(auth()->user()->id)->get();
        }
        foreach ($carts as $cart) {
            $region = $cart->product->getRegion();
            $region->pivot->count += $cart->count;
            $region->pivot->save();
            $cart->delete();
        }
    }

    public function clear()
    {
        if (Cookie::has('cart_token')) {
            $carts = Model::findByToken(Cookie::get('cart_token'))->get();
        } elseif (auth()->check()) {
            $carts = Model::findByUser(auth()->user()->id)->get();
        }

        foreach ($carts as $cart) {
            $this->delete($cart->product_id);
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function update($request)
    {
        $product = Product::findOrFail($request->product_id);
        $region = $product->getRegion();

        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken($request->cookie('cart_token'))->where('product_id', $request->product_id)->firstOrFail();
            $cart->update([
                'count' => $request->count
            ]);

            $count = Model::findByToken($request->cookie('cart_token'))->whereHas('product')->count();
        } elseif (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)->where('product_id', $request->product_id)->firstOrFail();
            abort_if(empty($region), 400, 'Not available in this region');
            abort_if($region->pivot->count < $request->input('count'), 400, 'Not available. Count - '.$region->pivot->count);

            if (isset($product->productable_type)) {
                if ($product->productable_type == 'warehouse') {
                    $url = env('WAREHOUSE_URL') . 'api/cart/';
                    $product_id = $product->id;
                    $region_id = Region::find(auth()->user()->region_id)->region_id;
                } else {
                    $url = env('SUPPLIERS_URL') . 'cart/';
                    $product_id = $product->productable_id;
                    $region_id = auth()->user()->region_id;
                }
                if ($request->count > $cart->count) {
                    $count = $request->count - $cart->count;
                    $url .= 'increase-number';

                    $region->pivot->count = $region->pivot->count - $count;
                } else {
                    $count = $cart->count - $request->count;
                    $url .= 'decrease-number';
                    $region->pivot->count = $region->pivot->count + $count;
                }
                $region->pivot->save();
                $response = $this->http->patch($url, [
                    'user' => auth()->id(),
                    'region' => $region_id,
                    'product' => $product_id,
                    'qty' => $count
                ]);
            }
            $cart->update([
                'count' => $request->count
            ]);

            $count = auth()->user()->cart()->whereHas('product')->count();
        }


//        $price = 0;
//        $price_discount = 0;
//        $price_current = 0;
//
//        $price += $cart->product->product->getPrice();
//        $price_discount += $cart->product->product->getDiscountPrice();
//
//        $price_current = $cart->product->product->price_discount ? $price_discount : $price;
        list($price) = $this->getProducts();

        $max_count = $product->getCount() + $cart->count;

        return [$price, $count, $max_count];
    }

    public function getBasketCount()
    {
        $count = 0;
        if (Cookie::has('cart_token')) {
            $count = Model::findByToken(Cookie::get('cart_token'))->whereHas('product')->count();
        } elseif (auth()->check()) {
            $count = auth()->user()->cart()->whereHas('product')->count();
        }

        return $count;
    }


    /**
     * @param $user_id
     */
    public function AddToCartUpdate($user_id)
    {
        $token = Cookie::get('cart_token');

        $carts = Model::findByToken($token)->get()->map(function ($cart) {
            return $cart->product_id;
        });

        $cart_user = Model::findByUser($user_id)->get()->map(function ($cart) {
            return $cart->product_id;
        });

        $product_id = array_diff($carts->toArray(), $cart_user->toArray());

        $carts = Model::whereIn('product_id', $product_id)->findByToken($token)->get();
        foreach ($carts as $cart) {
            $region = $cart->product->getRegion($user_id);
            if ($cart->product->productable_type == 'warehouse') {
                $url = env('WAREHOUSE_URL') . 'api/cart/add-product';
                $region_id = $region->region_id;
                $product_id = $cart->product_id;
            } else {
                $url = env('SUPPLIERS_URL') . 'cart/store';
                $region_id = $region->id;
                $product_id = $cart->product->productable_id;
            }
            $response = $this->http->post($url, [
                'user' => $user_id,
                'region' => $region_id,
                'product' => $product_id,
                'qty' => $cart->count
            ]);
            $cart->update([
                'token' => null,
                'user_id' => $user_id
            ]);
        }

        Cookie::queue(Cookie::forget('cart_token'));

    }
}
