<?php

namespace App\Jobs\Api\Address;

use App\Models\Address;
use App\Models\Currency;
use Illuminate\Support\Arr;
use App\Http\Requests\Api\Order\Request as OrderRequest;

class Store
{
    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['user_id', 'city', 'region', 'first_name', 'street', 'phone',  'apartment', 'floor', 'entrance']);
    }

    /**
     * @param $user_id
     * @param OrderRequest $request
     * @return Store
     */
    public static function fromRequest($user_id, OrderRequest $request)
    {
        return new static([
            'user_id' => $user_id,
            'city' => $request->getCity(),
            'region' => $request->getRegion(),
            'first_name' => $request->getFirstName(),
            'street' => $request->getStreet(),
            'phone' => $request->getPhone(),
            'apartment' => $request->getApartment(),
            'floor' => $request->getFloor(),
            'entrance' => $request->getEntrance()
        ]);
    }


    public function handle()
    {
        return Address::create($this->attr);
    }
}
