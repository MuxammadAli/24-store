<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Log\LogIndexResource;
use App\Http\Resources\Api\Order\OrderIndexResource;
use App\Models\Agent;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $req)
    {
        $orders = $req->input('orders');
        $orders = Order::whereIn('id', $orders)->get();
        return OrderIndexResource::collection($orders)->all();
    }

    /**
     * @param Order $order
     * @return OrderIndexResource
     */

    public function view(Order $order): OrderIndexResource
    {
        $order->loadMissing(['products' => function ($query) {
            $query->with('product:id,productable_id');
        }]);

        return new OrderIndexResource($order);
    }

    /**
     * @param Order $order
     * @return \App\Models\Address
     */
    public function address(Order $order): \App\Models\Address
    {
        $address = $order->address;
        $address->city_name = $address->getCity();
        return $address;
    }

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function status(Request $req)
    {
        try {
            if ($req->input('supplier') !== 0) {
                $supplier = Supplier::where('supplier_id', '=', $req->input('supplier'))->first();
                $order_status = OrderStatus::where('order_id', $req->input('order'))->where('supplier_id', $supplier->id)
                    ->firstOrFail();
            } else {
                $order_status = OrderStatus::where('order_id', $req->input('order'))->where('supplier_id', 0)->firstOrFail();
            }
            $order = Order::find($req->input('order'));
            if ($req->input('status') === 'cancelled' and $order_status->status !== 'cancelled') {
                foreach ($order->products as $product) {
                    $region = $product->product->getRegion($order->user_id);
                    $region->pivot->count += $product->count;
                    $region->pivot->save();
                }
                $order->user->coins -= $order->getCoins();
                $order->user->save();
                if ($order->statuses()->where('status', '!=', 'cancelled')->first() != null) {
                    $order->status = 'cancelled';
                    $order->save();
                }
            } elseif ($req->input('status') !== 'cancelled' and $order_status->status === 'cancelled') {
                foreach ($order->products as $product) {
                    $region = $product->product->getRegion($order->user_id);
                    $region->pivot->count -= $product->count;
                    $region->pivot->save();
                    $order->user->coins += $order->getCoins();
                    $order->user->save();
                }
            }
            $order_status->update([
                'status' => $req->input('status')
            ]);
            switch ($req->input('status')) {
                case 'processing':
                    if ($order->statuses()->where('status', 'new')->first() == null) $order->update(['status' => 'processing']);
                    break;
                case 'collected':
                    if ($order->statuses()->whereIn('status', ['new', 'processing'])->first() == null)
                        $order->update(['status' => 'collected']);
                    break;
                case 'delivery':
                    if ($order->statuses()->whereIn('status', ['new', 'processing', 'collected'])->first() == null)
                        $order->update(['status' => 'delivery']);
                    break;
                case 'closed':
                    if ($order->statuses()->whereIn('status', ['new', 'processing', 'collected', 'delivery'])->first() == null)
                        $order->update(['status' => 'closed']);
                    break;
            }
            return response(['status' => true]);
        } catch (HttpException $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode()
            ], $exception->getStatusCode());
        }

    }

    /**
     * @param Request $req
     * @return mixed
     */
    public function logs(Request $req)
    {
        $logs = Activity::orderBy('id', 'asc')->where('subject_type', 'App\Models\Order')->whereIn('subject_id', $req->input('orders'))->get();
        return LogIndexResource::collection($logs)->all();
    }

    /**
     * @param $order
     * @return mixed
     */
    public function log($order)
    {
        $logs = Activity::where('subject_type', 'App\Models\Order')->where('subject_id', $order)->get();
        return LogIndexResource::collection($logs)->all();
    }

    /**
     * @param Request $req
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function edit(Request $req, Order $order)
    {
        try {
            if ($req->has('create')) {
                foreach ($req->input('create') as $item) {
                    if ($req->input('type') == 'supplier') $product = Product::where('productable_id', $item['id'])->first();
                    else $product = Product::find($item['id']);
                    $region = $product->getRegion($order->user_id);
                    if ($region->pivot->count < $item['qty']) abort(500, 'Not enough quantity');
                    [$product->price, $product->price_discount] = $product->getRegionPrice($order->user_id);
                    $order->products()->create([
                        'product_id' => $product->id,
                        'count' => $item['qty'],
                        'price' => isset($product->price_discount) ? (int)$product->price_discount * $item['qty'] : (int)$product->price * $item['qty'],
                        'supplier_id' => $product->supplier_id
                    ]);
                    $region->pivot->count -= $item['qty'];
                    $region->pivot->save();
                }
            }
            if ($req->has('edit')) {
                foreach ($req->input('edit') as $item) {
                    if ($req->input('type') == 'supplier') $product = Product::where('productable_id', $item['id'])->first();
                    else $product = Product::find($item['id']);
                    $order_product = $order->products()->where('product_id', $product->id)->first();
                    [$product->price, $product->price_discount] = $product->getRegionPrice($order->user->id);
                    $region = $product->getRegion($order->user_id);
                    if ($item['qty'] > $order_product->count) {
                        $increase = $item['qty'] - $order_product->count;
                        if ($region->pivot->count < $item['qty']) abort(500, 'Not enough quantity');
                        $region->pivot->count -= $increase;
                    } elseif ($item['qty'] < $order_product->count) {
                        $decrease = $order_product->count - $item['qty'];
                        $region->pivot->count += $decrease;
                    }
                    $region->pivot->save();
                    $order->products()->where('product_id', $product->id)->delete();
                    $order->products()->create([
                        'product_id' => $product->id,
                        'count' => $item['qty'],
                        'price' => isset($product->price_discount) ? (int)$product->price_discount * $item['qty'] : (int)$product->price * $item['qty'],
                        'supplier_id' => $product->supplier_id
                    ]);
                }
            }

            if ($req->has('delete')) {
                foreach ($req->input('delete') as $item) {
                    if ($req->input('type') == 'supplier') $product = Product::where('productable_id', $item['id'])->first();
                    else $product = Product::find($item['id']);
                    $region = $product->getRegion($order->user_id);
                    $order_product = $order->products()->where('product_id', $product->id)->first();
                    $region->pivot->count += $order_product->count;
                    $region->pivot->save();
                    $order->products()->where('product_id', $product->id)->delete();
                }
            }
            return response(['status' => true]);
        } catch (HttpException $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode()
            ], $exception->getStatusCode());
        }
    }

    public function statistics()
    {
        return response()->json([
            'processing' => Order::where('status', 'processing')->get()->pluck('price_product')->sum(),
            'collected' => Order::where('status', 'collected')->get()->pluck('price_product')->sum(),
            'in_way' => Order::where('status', 'in_way')->get()->pluck('price_product')->sum(),
            'cancelled' => Order::where('status', 'cancelled')->get()->pluck('price_product')->sum(),
            'closed' => Order::where('status', 'closed')->get()->pluck('price_product')->sum(),
            'today' => Order::whereIn('status', ['processing', 'collected', 'in_way', 'closed'])
                ->whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])
                ->get()
                ->pluck('price_product')
                ->sum()
        ]);
    }

    public function agents(Request $req)
    {
        $query = Agent::select('id', 'first_name', 'last_name', 'patronymic');
        if ($req->has('agents'))
            $agents = $query->whereIn('id', $req->input('agents'))->get();
        else $agents = $query->get();

        return $agents->map(function ($agent) {
            return [
                'id' => $agent->id,
                'name' => $agent->getFullName()
            ];
        });
    }
}
