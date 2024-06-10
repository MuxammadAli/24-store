<?php

namespace App\Jobs\Cron;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;

class BackProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now = Carbon::parse(time() - 3600)->format('Y-m-d H:i:s');
        $back = Carbon::parse(time() - 360000000000)->format('Y-m-d H:i:s');

        $orders = Order::where('payment_status', 'waiting')->where('status', 'processing')->with('products')->whereBetween('created_at', [$back, $now])->get();

        foreach ($orders as $order) {
            $order->status = 'cancelled';
            $order->save();

            foreach ($order->products as $row) {
                $product  = Product::find($row->product_id);
                $product->count = $product->count + $row->count;
                $product->save();
            }
        }
    }
}
