<?php

namespace App\Http\Controllers\Site;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Region;
use App\User;
use App\Models\Address;
use App\Models\Currency;
use App\Models\Product;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\Site\Profile\Update as UpdateRequest;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
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
//        return auth()->user();
//        $favorites = auth()->user()->products()->published()->with([
//            'categories' => function ($category) {
//                return $category->select('id', 'name');
//            },
//            'brand:id,name',
//            'children:id,child_id'
//        ])->paginate(30);

//        $favorites->map(function (Product $product) {
//            $product->price = $product->getPrice();
//            $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();
//        });
//
//        $favorites->makeHidden([
//            'created_at', 'updated_at', 'deleted_at', 'child_id', 'published', 'slug',
//            'sizes', 'color_id', 'brand_id', 'poster', 'body', 'pivot'
//        ]);
//
//        $orders = auth()->user()->orders()->latest()->with('products')->whereHas('products')->get();

        return view('site.profile.index', ['regions' => Region::orderBy('name->ru')->get()]);
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        if ($request->input('region_id') !== auth()->user()->region_id) {
            (new \App\Helpers\Cart())->clear();
        }

        User::where('id', auth()->user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'birth_day' => $request->birth_day,
            'region_id' => $request->region_id,
            'name' => $request->input('name'),
            'inn' => $request->input('inn')
        ]);

        return redirect()->back()->with(['info' => trans('app.messages.updated')]);
    }

    public function address(Request $request)
    {
        if ($request->isMethod('get'))
            return view('site.profile.address');

        $attributes = [
            'user_id' => auth()->user()->id,
            'name' => $request->address['name'],
            'city' => $request->address['city'],
            'region' => $request->address['region'],
            'address' => $request->address['address'],
            'location' => $request->address['location']
        ];

        Address::create($attributes);

        $this->info(trans('app.messages.created'));

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function orders(Request $request)
    {
        $user = request()->user();

        $orders = $user->orders();

        switch ($request->get('type')) {
            case 'active':
                $orders = $orders->whereIn('status', ['collected', 'waiting_buyer', 'in_way', 'processing']);
                break;
            case 'closed':
                $orders = $orders->where('status', 'closed');
                break;
            default:
                $orders = $orders->where('status', 'waiting');
                break;
        }

        $orders = $orders->latest('id', 'desc')->get();

        foreach ($orders as $order) {
            if (empty($order->products[0]->product)) dd($order);
        }
        return view('site.profile.orders', compact('orders'));
    }

    public function repeatOrder(Order $order)
    {
        $http = Http::withBasicAuth(env('API_USERNAME'), env('API_USERNAME'))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]);
        foreach ($order->products as $product) {
            $cart = Order::findByUser(auth()->user()->id)->where('product_id', $product->product_id)->first();
            $region = Region::find(auth()->user()->region_id);
            $variant = $product->product->getRegion();
            if ($product->product->productable_type == 'warehouse') {
                $url = env('WAREHOUSE_URL') . 'api/cart/';
                $region_id = $region->region_id;
                $product_id  = $product->product_id;
            } else {
                $url = env('SUPPLIERS_URL') . 'cart/';
                $region_id = $region->id;
                $product_id = $product->product->productable_id;
            }

            if (!empty($cart)) {
                if ($cart->count > $product->count) {
                    $decrease = $cart->count - $product->count;
                    $variant->pivot->count += $decrease;

                    $http->patch($url .'decrease-number', [
                        'user' => auth()->id(),
                        'region' => $region_id,
                        'product' => $product_id,
                        'qty' => $decrease
                    ]);
                } elseif ($cart->count < $product->count) {
                    $increase = $product->count - $cart->count;
                    $variant->pivot->count -= $increase;

                    $http->patch($url .'increase-number', [
                        'user' => auth()->id(),
                        'region' => $region_id,
                        'product' => $product_id,
                        'qty' => $increase
                    ]);
                }
                $variant->pivot->save();
                $cart->update([
                    'count' => $product->count
                ]);
            } else {
                $cart = Cart::create([
                    'product_id' => $product->product_id,
                    'count' => $product->count,
                    'user_id' => auth()->id(),
                    'region_id' => auth()->user()->region_id
                ]);
                $variant->pivot->count -= $product->count;
                $variant->pivot->save();

                if ($cart->product->productable_type == 'warehouse') {
                    $response = $http->post(env('WAREHOUSE_URL') . 'api/cart/add-product', [
                        'user' => auth()->id(),
                        'region' => $region->region_id,
                        'product' => $cart->product_id,
                        'qty' => $cart->count
                    ]);
                } else {
                    $response = $http->post(env('SUPPLIERS_URL') . 'cart/store', [
                        'user' => auth()->id(),
                        'region' => auth()->user()->region_id,
                        'product' => $cart->product->productable_id,
                        'qty' => $cart->count
                    ]);
                }
            }

            $count = auth()->user()->cart()->whereHas('product')->count();
        }
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelOrder(Order $order): \Illuminate\Http\RedirectResponse
    {
        $order->status = 'cancelled';
        $order->save();
        return back();
    }

    /**
     * @param Address $address
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addressUpdate(Address $address, Request $request)
    {
        $attributes = [
            'name' => $request->address['name'],
            'city' => $request->address['city'],
            'region' => $request->address['region'],
            'address' => $request->address['address'],
            'location' => $request->address['location']
        ];

        $address = $address->update($attributes);

        $this->info(trans('app.messages.updated'));

        return response()->json([
            'status' => true
        ]);
    }
}
