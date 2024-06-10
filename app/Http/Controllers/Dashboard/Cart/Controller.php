<?php

namespace App\Http\Controllers\Dashboard\Cart;

use App\Http\Controllers\Controller as ExController;
use App\Models\Cart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class Controller extends ExController
{

    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private $http;

    public function __construct()
    {
        $this->http = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sql = Cart::orderBy('updated_at', 'desc')->toSql();
        $carts = Cart::where('token', null)->orWhere('user_id', null)
            ->select('token', 'user_id', DB::raw('max(updated_at) as date'))->orderBy('date', 'desc')
            ->groupBy('token', 'user_id')->paginate(request('paginate', 10));

        $carts->map(function ($cart) {
            if ($cart->token) {
                $last_cart = Cart::where('token', $cart->token)
                    ->latest('updated_at')
                    ->first();
                $cart->cart_count = Cart::where('token', $cart->token)->count();
            } else {
                $last_cart = Cart::where('user_id', $cart->user_id)
                    ->latest('updated_at')
                    ->first();
                $cart->cart_count = Cart::where('user_id', $cart->user_id)->count();
                $cart->phone = $cart->user->phone;
            }
            $cart->region = $last_cart->region;

            $date = strtotime('+24 hours', strtotime($last_cart->updated_at));
            $diff = $date - time();
            $days = floor($diff / (60 * 60 * 24));
            $hours = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));
            $minutes = floor(($diff - $days * 60 * 60 * 24) % (60 * 60) / 60);
            $cart->update = date('H:i d.m.Y', strtotime($last_cart->updated_at));
            $cart->time = strtotime($last_cart->updated_at);
            $cart->deadline = "{$hours} часов, {$minutes} минут";
        });

        return view('dashboard.cart.index', [
            'carts' => $carts
        ]);
    }

    /**
     * @param $key
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($key)
    {
        if (is_numeric($key)) $carts = Cart::where('user_id', $key)
            ->latest('updated_at')
            ->paginate(request('paginate', 10));
        else $carts = Cart::where('token', $key)
            ->latest('updated_at')
            ->paginate(request('paginate', 10));
        return view('dashboard.cart.show', compact('carts', 'key'));
    }

    /**
     * @param Cart $cart
     * @param $count
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addCount(Cart $cart, $count)
    {
        $region = $cart->product->regions()->where('id', '=', $cart->region_id)->first();
        if ($region->pivot->count >= $count) {
            $region->pivot->count -= $count;
            $region->pivot->save();
            $cart->count += $count;
            $cart->save();
            return response(['status' => true]);
        }
        return response(['status' => false, 'count' => $region->pivot->count]);
    }

    /**
     * @param Cart $cart
     * @param $count
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function minusCount(Cart $cart, $count)
    {
        $region = $cart->product->regions()->where('id', '=', $cart->region_id)->first();
        $region->pivot->count += $count;
        $region->pivot->save();
        $cart->count -= $count;
        $cart->save();
        return response(['status' => true]);
    }

    /**
     * @param Cart $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Cart $cart): \Illuminate\Http\RedirectResponse
    {
        $region = $cart->product->regions()->where('id', '=', $cart->region_id)->first();
        $region->pivot->count += $cart->count;
        $region->pivot->save();
        $cart->delete();
        $this->error(trans('admin.delete'));
        return back();
    }

    /**
     * @param $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear($key): \Illuminate\Http\RedirectResponse
    {
        if (is_numeric($key)) $carts = Cart::where('user_id', $key)->get();
        else $carts = Cart::where('token', $key)->get();
        foreach ($carts as $cart) {
            $region = $cart->product->regions()->where('id', '=', $cart->region_id)->first();
            $region->pivot->count += $cart->count;
            $region->pivot->save();
            $cart->delete();
        }
        if (is_numeric($key)) $this->http->delete(env('WAREHOUSE_URL') . 'api/cart/clear/' . $key);
        $this->error(trans('admin.delete'));
        return redirect()->route('dashboard.cart.index');
    }
}
