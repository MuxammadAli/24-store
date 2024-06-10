<?php

namespace App\Http\Controllers\Apelsin;

use App\Models\CommentBank;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller as ExController;
use Spatie\Activitylog\Models\Activity;

class Controller extends ExController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $sign_key = md5($request->order_number.'secret key');

        if ($sign_key == $request->sign_key) {
//            Activity::create([
//                'log_name' => 'orders',
//                'description'
//            ]);
            $order = Order::find($request->order_number);

            if (!empty($order)) {
                $order->update([
                    'payment_status' => 'review'
                ]);
            }

            return response()->json([
                'status' => true,
                'back_url' => env('APP_URL').'?order=credit'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error Sign Key'
            ], 403);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $sign_key = md5($request->order_number.'secret key');

        if ($sign_key === $request->sign_key) {
            $order = Order::find($request->order_number);

            if (!empty($order)) {
                if ($request->result) {
                    if ($order->status == 'cancelled') {
                        $order->update([
                            'payment_status' => 'payed',
                            'status' => 'processing',
                            'archived' => false,
                        ]);
                    } else {
                        $order->update([
                            'payment_status' => 'payed',
                        ]);
                    }
                } else {

                    $order->update([
                        'apelsin_data' => [
                            'status' => false,
                            'body' => $request->all()
                        ],
                        'status' => 'cancelled',
                        'payment_status' => 'cancelled'
                    ]);
                }
            }

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error Sign Key'
            ], 403);
        }
    }


    /**
     * @param $id
     * @return array
     */
    public function delivered($id)
    {
        try {
            $response = Http::withBasicAuth('keys apelsin', 'password apelsin')
                        ->post('', [
                            'order_number' => $id,
                            'status' => true
                        ]);
        } catch (\Exception $exception) {
            return [
                'status' => false,
                'body' => $exception
            ];
        }

        $body = json_decode($response->body(), true);

        if ($body['errorMessage']) {
            return [
                'status' => false,
                'body' => $body
            ];
        }

        return [
            'status' => true,
            'body' => $body
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(Request $request)
    {
        $sign_key = md5($request->order_number.'secret key');

        if ($sign_key == $request->sign_key) {
            $order = Order::find($request->order_number);

            if (!empty($order) && $order->payment_type == 'credit') {
                $comment = $request->comment;
                CommentBank::create([
                    'order_id' => $order->id,
                    'comment' => $comment
                ]);
            }

            return response()->json([
                'status' => true,
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Error Sign Key'
        ], 403);
    }

}
