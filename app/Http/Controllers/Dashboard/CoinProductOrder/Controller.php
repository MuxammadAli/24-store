<?php

namespace App\Http\Controllers\Dashboard\CoinProductOrder;

use App\Http\Controllers\Controller as ExController;
use App\Models\City;
use App\Models\CoinProductOrder;
use App\Models\Region;
use Illuminate\Http\Request;

class Controller extends ExController
{
    public function index()
    {
        return view('dashboard.coin-product-order.index', [
            'orders' => CoinProductOrder::orderBy('id', 'desc')->paginate(20),
            'regions' => Region::all(),
            'cities' => City::all()
        ]);
    }

    public function status(CoinProductOrder $coinProductOrder, $status)
    {
        $coinProductOrder->update(['status' => $status]);
        $this->success(trans('admin.edit'));
        return back();
    }
}
