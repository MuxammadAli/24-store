<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CoinProduct\CoinProductOrderRequest;
use App\Models\CoinProduct;
use App\Models\CoinProductOrder;
use App\User;
use Illuminate\Http\Request;

class CoinProductController extends Controller
{
    /**
     * @param CoinProduct $coinProduct
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(CoinProduct $coinProduct, $slug)
    {
        $coinProduct->update([
            'views' => $coinProduct->views + 1
        ]);

        $coinProduct->makeHidden(['created_at', 'updated_at']);

        $category = $coinProduct->category;
        $popularProducts = CoinProduct::all();
        $coinProduct->loadMissing('unit', 'screens');
        return view('site.coin-product.show', [
            'product' => $coinProduct,
            'category' => $category,
            'popularProducts' => $popularProducts
        ]);
    }

    /**
     * @param CoinProductOrderRequest $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function order(CoinProductOrderRequest $req)
    {
        $product = CoinProduct::find($req->input('product'));
        $price = $product->price_discount != 0 ? $product->price_discount : $product->price;
        $price *= $req->input('count', 1);
        $user = User::find(auth()->id());
        if ($user->coins >= $price) {
            CoinProductOrder::create([
                'coin_product_id' => $req->input('product'),
                'user_id' => $user->id,
                'count' => $req->input('count')
            ]);
            $coins = $user->coins;
            $user->update(['coins' => $coins - $price]);
            $user->save();
            return response(['status' => true], 201);
        }
        return response(['status' => false, 'message' => 'Not enough coins, '.$price], 500);
    }
}
