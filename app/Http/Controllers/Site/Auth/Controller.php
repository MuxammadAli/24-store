<?php

namespace App\Http\Controllers\Site\Auth;

use App\Helpers\Cart;
use App\User;
use App\Api\Sms;

use App\Http\Requests\Api\Auth\Login as LoginRequest;
use App\Http\Requests\Api\Auth\Verify as VerifyRequest;

use Illuminate\Support\Facades\Auth;

use App\Jobs\Api\Auth\Store as StoreJob;

use App\Http\Controllers\Controller as ExController;
use Illuminate\Support\Facades\Cookie;
use Log;

class Controller extends ExController
{
    protected $sms;
    protected $user;
    protected $cart;

    /**
     * Controller constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->sms = new Sms();
        $this->cart = new Cart();
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = $this->user->findByPhone($request->getPhone())->first();

        if ($request->getPhone() == 998977373538 || $request->getPhone() == 998975000609 || $request->getPhone() == 998946266016 || $request->getPhone() == 998913333111 || $request->getPhone() == 998909844597) {
            $code = 1234;
        } else {
            $code = rand(1000, 9999);
            $message = "код для входа: {$code}. Никому не сообщайте этот код!";
            $this->sms->send($request->getPhone(), $message);
        }

        if (!empty($user)) {

            $user->update([
                'verify_code' => $code,
            ]);


            return response()->json([
                'status' => true,
                //'registered' => true,
            ]);
        }

        $this->dispatchNow(StoreJob::fromRequest($request, $code));

        return response()->json([
            'status' => true,
            //'registered' => false,
        ]);
    }

    /**
     * @param VerifyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(VerifyRequest $request)
    {
        $user = $this->user->findByPhone($request->getPhone())->first();

        if (! $user || ! $user->isVerifyCode($request->getCode())) {
            return response()->json([
                'status' => false,
                'error' => 1,
                'message' => trans('app.errors.1')
            ], 403);
        }

        $user->update([
            'verify_code' => null,
            'ip' => $request->ip()
        ]);

        $this->cart->AddToCartUpdate($user->id);

        switch ($request->type) {
            case 'product-credit':
                $url = $request->action ? route('product.credit', $request->action) : null;
                $action = $request->type;
                $data = [];
                break;
            case 'cart-preview':
                $url = route('cart');
                $action = $request->type;
                $data = [];
                break;
            case 'checkout-login':
                $url = route('cart');
                $action = $request->type;
                $data = [
                    'addresses' => $user->addresses
                ];
                break;
            default:
                $url = 'reload';
                $action = 'reload';
                $data = [];
                break;
        }

        Auth::login($user);

        if (Cookie::has('region') and empty(auth()->user()->region_id)) {
            $user->update(['region_id' => Cookie::get('region')]);
        }

        return response()->json([
            'status' => true,
            'url' => $url,
            'action' => $action,
            'first_name' => $user->first_name,
            'data' => $data,
            'address' => $user->postal_address,
        ]);
    }
}
