<?php

namespace App\Http\Controllers\Dashboard\ProductNotification;

use App\Http\Controllers\Controller as ExController;
use App\Models\ProductNotification;
use Illuminate\Http\Request;

class Controller extends ExController
{
    public function index()
    {
        ProductNotification::where('seen', false)->update(['seen' => true]);
        return view('dashboard.product-notification.index', [
            'notifications' => ProductNotification::orderBy('id', 'desc')->paginate(request('paginate', 15))
        ]);
    }
}
