<?php

namespace App\Jobs\Dashboard\Currency;

use App\Models\Currency;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Currency\Store as StoreRequest;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['dollar', 'euro']);
    }

    /**
     * @param StoreRequest $request
     * @return Store
     */
    public static function fromRequest(StoreRequest $request)
    {
        return new static([
            'dollar' => $request->getDollar(),
            'euro' => $request->getEuro()
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Currency::create($this->attr);
    }
}
