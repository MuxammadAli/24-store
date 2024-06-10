<?php

namespace App\Jobs\Cron;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;

class CloseOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $from = '2020-01-01 00:00:01';
        $to = Carbon::parse(time() - 7200)->format('Y-m-d H:i:s');

        $orders = Order::where('payment_type', 'credit')->where('payment_status', 'waiting')->whereBetween('created_at', [$from, $to])->get();

        foreach ($orders as $order) {
            $order->update([
                'payment_status' => 'cancelled',
                'archived' => true,
                'status' => 'cancelled'
            ]);
        }
    }
}
