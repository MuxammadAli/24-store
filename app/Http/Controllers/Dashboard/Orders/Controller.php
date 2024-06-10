<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Api\Sms;
use App\Exports\OrdersExport;
use App\Models\Address;
use App\Models\Branch;
use App\Models\City;
use App\Models\Currency;
use App\Models\OrdersComment;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Region;
use App\Models\Setting;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Http\Controllers\Controller as ExController;

use App\Jobs\Dashboard\Order\Update as UpdateJob;
use App\Jobs\Dashboard\Order\Products as ProductsUpdateJob;

use App\Http\Requests\Dashboard\Order\Update as UpdateRequest;

use Illuminate\Support\Facades\Http;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\Apelsin\Controller as ApelsinController;
use Spatie\Activitylog\Models\Activity;

class Controller extends ExController
{
    protected $orders;
    protected $order_products;
    protected $products;
    protected $currency;
    protected $sms;
    protected $apelsin;

    /**
     * Controller constructor.
     * @param Order $order
     * @param OrderProducts $order_products
     * @param Product $product
     * @param Currency $currency
     */
    public function __construct(Order $order, OrderProducts $order_products, Product $product, Currency $currency)
    {
        $this->orders = $order;
        $this->products = $product;
        $this->order_products = $order_products;
        $this->sms = new Sms();
        $this->currency = $currency->latest('id', 'desc')->limit(1)->first();
        $this->apelsin = new ApelsinController();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'orders');

        if (request()->get('direction') === 'asc') $direction = 'desc';
        else $direction = 'asc';
        $orders = $this->orders->orderBy(request()->get('column', 'id'), request()->get('direction', 'desc'))->archived(false);

        $orders = $orders->paginate(20);

        $regions = Region::orderBy('name->ru', 'asc')->get();
        $cities = City::orderBy('name->ru', 'asc')->get();

        return view('dashboard.orders.index', compact('orders', 'regions', 'cities', 'direction'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function view(Order $order)
    {
        $this->authorize('view', 'orders');
        $products = $this->order_products->where('order_id', $order->id)->get();
        $products->map(function ($product) {
            [$product->price, $product->price_discount] = $product->product->getRegionPrice();
        });
        $logs = Activity::orderBy('id', 'asc')->where('subject_type', 'App\Models\Order')->where('subject_id', $order->id)->get();
        $ids = $products->pluck('supplier_id')->unique();
        $statuses = $order->statuses;
        $statuses = $statuses->map(function (OrderStatus $status) use ($order) {
            if ($status->supplier_id == 0) return (object)[
                'id' => 0,
                'name' => '24seven',
                'status' => $status->status,
                'status_text' => $status->getStatus(),
                'status_color' => $status->getStatusColor()
            ];
            else return (object)[
                'id' => $status->supplier_id,
                'name' => $status->supplier->name,
                'status' => $status->status,
                'status_text' => $status->getStatus(),
                'status_color' => $status->getStatusColor()
            ];
        });
        $setting = Setting::find(1);
        return view('dashboard.orders.view', compact('order', 'products', 'setting', 'logs', 'statuses'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoice_print(Order $order)
    {
        return view('invoice', compact('order'));
//        $path = public_path().'/pdf';
//        $pdf = PDF::loadView('invoice');
//        return $pdf->download('medium.pdf');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $orders = $this->orders->latest('id')->where('id', $request->get('id'))->paginate(20);
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     *
     */
    public function archive()
    {
        $orders = $this->orders->latest('id')->archived(true)->paginate(20);
        return view('dashboard.orders.archive', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mass_archived(Request $request)
    {
        switch ($request->input('action')) {
            case "unarchive":
                Order::whereIn('id', $request->order_id)->update([
                    'archived' => false
                ]);
                break;
            case "archived":
                Order::whereIn('id', $request->order_id)->update([
                    'archived' => true
                ]);
                break;
        }

        $this->info('Успешно перенесен в архив');
        return redirect()->back();
    }


    /**
     * @param Order $order
     * @param UpdateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Order $order, UpdateRequest $request)
    {
        $branches = Branch::all();
        if ($request->isMethod('get')) {
            $this->authorize('update', 'orders');
            $order->loadMissing([
                'address.cityy.region',
                'products' => function ($product) {
                    return $product->select('order_id', 'product_id', 'count', 'color_id', 'size', 'discount')->with([
                        'product' => function ($product) {
                            return $product->select('id', 'name', 'price', 'price_discount', 'images', 'unit_id')->with('unit');
                        }
                    ]);
                },
                'branch:id,name'
            ]);


            foreach ($order->products as $product) {
                $product->product->price = $product->price_discount ? $product->product->price_discount : $product->product->price;
                $product->price_discount = $product->product->price_discount == null ? null : $product->product->getDiscountPrice();
                $product->product->poster_thumb = $product->product->getPosterThumb();
            }
            $order->region_id = $order->user->region_id;

            return view('dashboard.orders.update', compact('order', 'branches'));
        }

        //$address = Address::find($order->address_id);

        $this->dispatchNow(UpdateJob::fromRequest($order, $request));
        //$this->dispatchNow(AddressUpdateJob::fromRequest($address, $request));
        $this->dispatchNow(new ProductsUpdateJob($order, $request));

        $this->info(trans('admin.messages.updated'));

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function product(Product $product)
    {
        $product->makeHidden([
            'body', 'name', 'brand_id', 'child_id', 'slug', 'published', 'updated_at', 'created_at', 'deleted_at',
            'poster', 'poster_thumb', 'price', 'price_discount'
        ]);

        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search_update(Request $request)
    {
        $query = $request->name;
        $region = $request->region_id;

        $product = $this->products->where('name->ru', 'ilike', '%' . $query . '%')
            ->isAvailableInRegion($region)->get()
            ->map(function (Product $product) {
                return [
                    'id' => $product->id,
                    'poster' => $product->getPosterThumb(),
                    'name' => $product->name['ru']
                ];
            });

        return response()->json([
            'status' => true,
            'products' => $product
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function product_info(Product $product)
    {
        $this->authorize('view', 'orders');
//        if ($product->currency == 'dollar') {
//            $product->price = round($product->price * $this->currency->dollar, -3);
//            $product->price_discount = $product->price_discount == null ? null : round($product->price_discount * $this->currency->dollar, -3);
//        } else {
//            $product->price = round($product->price * $this->currency->euro, -3);
//            $product->price_discount = $product->price_discount == null ? null : round($product->price_discount * $this->currency->euro, -3);
//        }

        $product->price = $product->getPrice();
        $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();
        $product->poster_thumb = $product->getPosterThumb();

        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }

    /**
     * @param Order $order
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change_status(Order $order, $status)
    {
        if ($status == 'cancelled') {
            if ($order->price_product > 300000) {
                $i = $order->price_product / 300000;
                $coins = $order->user->coins;
                $coins -= floor($i);
                $order->user->update(['coins' => $coins]);
            }
        } elseif ($status != 'cancelled' and $order->status == 'cancelled') {
            if ($order->price_product > 300000) {
                $i = $order->price_product / 300000;
                $coins = $order->user->coins;
                $coins += floor($i);
                $order->user->update(['coins' => $coins]);
            }
        }
        switch ($status) {
            case 'processing':
                if (!empty(auth()->user()->role->permissions['order_status']['processing']) || !empty(auth()->user()->role->permissions['order_status']['collected']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "24seven vash zakaz: {$order->id} podtverjden!";
                    Http::withBasicAuth(env('API_USERNAME'), env('API_USERNAME'))
                        ->patch(env('WAREHOUSE_URL') . 'api/order/processing/' . $order->id);
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;

            case 'collected':
                if (!empty(auth()->user()->role->permissions['order_status']['collected']) || !empty(auth()->user()->role->permissions['order_status']['waiting_buyer']) || !empty(auth()->user()->role->permissions['order_status']['in_way']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "24seven vash zakaz: {$order->id} prinyat!";
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;
            case 'waiting_buyer':
                if (!empty(auth()->user()->role->permissions['order_status']['waiting_buyer']) || !empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "24seven vash zakaz: {$order->id} mi vas jdem!";
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;
            case 'in_way':
                if (!empty(auth()->user()->role->permissions['order_status']['in_way']) || !empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "24seven vash zakaz: {$order->id} otpravlen!";
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;

            case 'cancelled':
                Http::withBasicAuth(env('API_USERNAME'), env('API_USERNAME'))
                    ->patch(env('WAREHOUSE_URL') . 'api/order/cancel/' . $order->id);
                break;
            case 'replacement':
                break;

        }

        $this->sms->send($order->user->phone, $message);
        $order->save();

        $this->info(trans('admin.messages.updated'));

        return redirect()->back();
    }

    public function filter(Request $request)
    {
        if ($request->get('direction') === 'asc') $direction = 'desc';
        else $direction = 'asc';
        $id = empty($request->get('id')) ? null : $request->get('id');
        $type_delivery = empty($request->get('delivery_type')) ? null : $request->get('delivery_type');
        $status = empty($request->get('delivery_status')) ? null : $request->get('delivery_status');
        $pay_status = empty($request->get('pay_status')) ? null : $request->get('pay_status');
        $from = empty($request->get('from')) ? Carbon::parse('2000-01-01')->format('Y-m-d') : Carbon::parse($request->get('from'))->format('Y-m-d');
        $to = empty($request->get('to')) ? Carbon::parse('2040-01-01')->format('Y-m-d') : Carbon::parse($request->get('to'))->format('Y-m-d');
        $user = empty($request->get('user')) ? null : $request->get('user');
        $region = empty($request->get('region_id')) ? null : $request->get('region_id');
        $city = empty($request->get('city_id')) ? null : $request->get('city_id');
//        return $request->all();

        $orders = $this->orders->orderBy(request()->get('column', 'id'), request()->get('direction', 'desc'))
            ->when($id ?? null, function ($query, $id) {
                $query->where('id', $id);
            })->when($type_delivery ?? null, function ($query, $type_delivery) {
                $query->where('type_delivery', $type_delivery);
            })->when($status ?? null, function ($query, $status) {
                $query->where('status', $status);
            })->when($region ?? null, function ($query, $region) {
                $addresses = Address::where('region_id', $region)->get()->pluck('id');
                $query->whereIn('address_id', $addresses);
            })->when($city ?? null, function ($query, $city) {
                $addresses = Address::where('city_id', $city)->get()->pluck('id');
                $query->whereIn('address_id', $addresses);
            });

        if ($pay_status == 2) {
            $orders = $orders->when($pay_status ?? null, function ($query, $pay_status) {
                $query->where('status', 4);
            });
        } else {
            $orders = $orders->when($pay_status ?? null, function ($query, $pay_status) {
                $query->where('payment_status', $pay_status);
            });
        }

        $orders = $orders->whereHas('user', function ($query) use ($user) {
            $query->when($user ?? null, function ($query, $user) {
                $phone = str_replace(['(', ')', ' ', '+'], '', $user);
                $query->where('phone', $phone);
            });
        });

        if ($from == date('Y-m-d') and $to == date('Y-m-d'))
            $orders = $orders->whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])->paginate(20);
        elseif ($from == $to) $orders = $orders->whereBetween('created_at', [
            date('Y-m-d', strtotime($from)),
            date('Y-m-d', strtotime('+24 hours', strtotime($to))),
        ])->paginate(20);
        else $orders = $orders->whereBetween('created_at', [$from, $to])
            ->paginate(20);

        $regions = Region::orderBy('name->ru', 'asc')->get();
        $cities = City::orderBy('name->ru', 'asc')->get();

        return view('dashboard.orders.index', compact('orders', 'regions', 'cities', 'direction'));
    }

    public function comments(Request $request)
    {
        $order = Order::find($request->order_id);

        switch ($request->type) {
            case 'cancelled':
                if (!empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = 'cancelled';
                    Http::withBasicAuth(env('API_USERNAME'), env('API_USERNAME'))
                        ->delete(env('WAREHOUSE_URL') . 'api/order/cancel/' . $order->id);
                    foreach ($order->products as $row) {
                        $product = Product::find($row->product_id);
                        if (!empty($product)) {
                            $product->count = $product->count + $row->count;
                            $product->save();
                        }
                    }
                    $message = "24seven vash zakaz: {$order->id} otmenen!";
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;

            case 'replacement':
                if (!empty(auth()->user()->role->permissions['order_status']['replacement'])) {
                    $order->status = 'replacement';
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;
            case 'closed':
                if (!empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled']) || !empty(auth()->user()->role->permissions['order_status']['replacement'])) {
                    $order->status = 'closed';

                    if ($order->payment_type == 'credit') {
                        $apelsin = $this->apelsin->delivered($order->id);

                        $order->update([
                            'apelsin_data' => $apelsin
                        ]);
                    }


                    $message = "24seven vash zakaz: {$order->id} zavershen!";
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;
        }

        if (!empty($message)) {
            $this->sms->send($order->user->phone, $message);
        }

        if ($request->type != 'default')
            $order->save();

        OrdersComment::create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
            'order_id' => $request->order_id,
            'type' => $request->type
        ]);

        if ($order->payment_type == 'credit' && $request->type == 'closed') {
            if ($apelsin['status']) {
                $this->info(trans('admin.messages.updated'));
            } else {
                $this->error('Произошла ошибка в Apelsin Credit');
            }
        } else {
            $this->info(trans('admin.messages.updated'));
        }
        return redirect()->back();
    }

    public function export()
    {
        $orders = Order::all();
        return Excel::download(new OrdersExport, 'reports.xlsx');
    }
}
