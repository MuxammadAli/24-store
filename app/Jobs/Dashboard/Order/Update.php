<?php

namespace App\Jobs\Dashboard\Order;

use App\Models\Order;
use Illuminate\Support\Arr;

use App\Http\Requests\Dashboard\Order\Update as UpdateRequest;

class Update
{

    protected $attr;
    protected $order;

    /**
     * Update constructor.
     * @param Order $order
     * @param array $attr
     */
    public function __construct(Order $order, array $attr = [])
    {
        $this->order = $order;
        $this->attr = Arr::only($attr, ['price_product']);
    }

    /**
     * @param Order $order
     * @param UpdateRequest $request
     * @return Update
     */
    public static function fromRequest(Order $order, UpdateRequest $request)
    {
        return new static($order, [
            'price_product' => $request->getProductTotal(),
        ]);
    }

    /**
     * @return bool
     */
    public function handle()
    {
        return $this->order->update($this->attr);
    }
}
