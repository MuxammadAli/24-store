<?php

namespace App\Http\Controllers\Site;

use App\Api\Sms;
use App\Helpers\Cart;
use App\Jobs\Site\Checkout\ProductsOrderStoreJob;
use App\Models\Address;
use App\Models\Cart as CartModel;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;
use App\Models\Region;
use App\Models\Setting;

use App\Jobs\Site\Checkout\StoreJob;
use App\Jobs\Site\Checkout\BillingStoreJob;
use App\Jobs\Site\Checkout\AddressStoreJob;
use App\Http\Requests\Site\Checkout\StoreRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{

    protected $cart;
    protected $currency;
    protected $sms;

    /**
     * CheckoutController constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->cart = new Cart();
        $this->currency = $currency->latest('id', 'desc')->limit(1)->first();
        $this->sms = new Sms();
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(StoreRequest $request)
    {
        $setting = Setting::first();
        $delivery_price = $setting->price_delivery;
        $pickup = $setting->pickup;
        $delivery = $setting->delivery;
        $pickup_text = $setting->pickup_text;

        if ($request->isMethod('get')) {
            list($prices, $cart) = $this->cart->getProducts();

            if (count($cart) == 0)
                return redirect()->route('cart');

            $regions = Region::with('cities')->orderBy('id', 'asc')->get();

            return view('site.checkout.index', compact('prices', 'cart', 'regions', 'delivery_price', 'delivery', 'pickup', 'pickup_text'));
        }

        $product_total = 0;

        foreach ($request->products as $product) {
            $cart = CartModel::findByUser(auth()->user()->id)->where('id', $product)->first();
            if (!empty($cart)) {

                [$price, $price_discount] = $cart->product->getRegionPrice();
                $product_total += $price_discount ? $price_discount * $cart->count : $price * $cart->count;
            }
        }

        $total = $product_total + $delivery_price;

        DB::beginTransaction();
        if ($request->address['id']) {
            $address = Address::find($request->address['id']);
            $address->location = $request->address['location'];
            $address->region_id = $request->address['region_id'];
            $address->city_id = $request->address['city_id'];
            $address->address = $request->address['address'];
            $address->save();
        } else {
            $address = $this->dispatchNow(new AddressStoreJob($request));
        }

        try {
            $order = $this->dispatchNow(new StoreJob($request, $address, $delivery_price, $this->currency, $product_total));
            $carts = CartModel::whereIn('id', $request->input('products'))->get();
            if (Product::whereIn('id', $carts->pluck('product_id'))
                    ->where('productable_type', 'warehouse')->first() !== null) {
                $response = Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
                    ->post(env('WAREHOUSE_URL') . 'api/order/create', [
                        'site_id' => $order->id,
                        'user' => auth()->id(),
                        'region' => Region::find(auth()->user()->region_id)->region_id
                    ]);
            }
            if (Product::whereIn('id', $carts->pluck('product_id'))
                ->where('productable_type', 'supplier')->first() !== null) {
                $response = Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
                    ->post(env('SUPPLIERS_URL') . 'order/store', [
                        'site_id' => $order->id,
                        'user' => auth()->id(),
                        'region' => auth()->user()->region_id
                    ]);
                if (empty($response->object()->status)) {
                    echo $response->body();
                    dd([
                        'site_id' => $order->id,
                        'user' => auth()->id(),
                        'region' => auth()->user()->region_id
                    ]);
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'errors' => [
                    'error' => 'Try again',
                    'message' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                    'mess' => $exception->getFile(),
                    'code' => $exception->getCode()
                ]
            ]);
        }

        try {
            $this->dispatchNow(new ProductsOrderStoreJob($request, $order));
            $coin_price = Setting::first()->coin_price;
            if ($order->price_product > $coin_price) {
                $i = $order->price_product / $coin_price;
                $coins = $order->user->coins;
                $coins += floor($i);
                $order->user->update(['coins' => $coins]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'errors' => [
                    'error' => 'Try again',
                    'message' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                    'mess' => $exception->getFile(),
                    'code' => $exception->getCode()
                ]
            ]);
        }

        try {
            foreach ($order->products->unique('supplier_id') as $product) {
                $order->statuses()->create(['supplier_id' => $product->supplier_id]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'error' => 'Try again',
                    'message' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                    'mess' => $exception->getFile(),
                    'code' => $exception->getCode()
                ]
            ]);
        }

        try {
            $billing = $this->dispatchNow(new BillingStoreJob($order, $total, $request->order['payment_type']));
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'errors' => [
                    'error' => 'Try again',
                    'mess
                    age' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                    'mess' => $exception->getFile(),
                    'code' => $exception->getCode()
                ]
            ]);
        }

        $message = "Заказ {$order->id} принят на обработку. Он сохранился в истории заказов";
        $this->sms->send($order->user->phone, $message);

        $url = '/?order=success';

        CartModel::whereIn('id', $request->products)->delete();

        DB::commit();
        return response()->json([
            'status' => true,
            'url' => $url
        ]);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function check(Request $request, Order $order)
    {
        if ($request->isMethod('post')) {
            if ($order->payment_status == 'waiting')
                return redirect()->route('payment.merchant', [$request->payment_type, $order->billing->id, $order->billing->amount]);
        }

        if ($order->payment_status == 'waiting')
            return view('site.payment_retry', compact('order'));

        if ($order->payment_status == 'payed' || $order->payment_status == 'cash')
            return redirect('/?order=success');

    }

}
