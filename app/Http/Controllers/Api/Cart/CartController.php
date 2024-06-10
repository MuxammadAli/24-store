<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Resources\Api\Cart\CartIndexResource;
use App\User;
use Illuminate\Http\Request;

class CartController
{
    public function index(Request $req)
    {
        $users = User::whereIn('id', $req->input('users'))->get();
        $users->map(function (User $user) {
            $cart = $user->cart()->orderBy('updated_at', 'desc')->first();
            if (isset($cart)) {
                $deadline = strtotime(date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($cart->updated_at))));
                $user->deadline = ($deadline - strtotime(date('Y-m-d H:i:s'))) * 1000;
            } else $user->deadline = null;
        });
        return CartIndexResource::collection($users)->all();
    }
}
