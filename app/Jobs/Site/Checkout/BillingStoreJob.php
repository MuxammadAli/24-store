<?php

namespace App\Jobs\Site\Checkout;

use App\Models\Billing;

class BillingStoreJob
{

    protected $order;
    protected $total;
    protected $payment_system;

    public function __construct($order, $total, $payment_system)
    {
        $this->order = $order;
        $this->total = $total;
        $this->payment_system = $payment_system;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Billing::create([
            'order_id' => $this->order->id,
            'amount' => $this->total,
            'payment_system' => $this->payment_system
        ]);
    }
}
