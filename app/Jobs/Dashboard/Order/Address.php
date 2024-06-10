<?php

namespace App\Jobs\Dashboard\Order;

use Illuminate\Support\Arr;
use App\Models\Address as Model;
use App\Http\Requests\Dashboard\Order\Update as UpdateRequest;


class Address
{

    protected $attr;
    protected $address;

    /**
     * Address constructor.
     * @param Model $address
     * @param array $attr
     */
    public function __construct(Model $address, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['city', 'first_name', 'phone', 'region', 'street', 'apartment', 'floor', 'entrance']);
        $this->address = $address;
    }

    /**
     * @param Model $address
     * @param UpdateRequest $request
     * @return Address
     */
    public static function fromRequest(Model $address, UpdateRequest $request)
    {
        return new static($address, [
            'city' => $request->getCity(),
            'region' => $request->getRegion(),
            'street' => $request->getStreet(),
            'apartment' => $request->getApartment(),
            'floor' => $request->getFloor(),
            'entrance' => $request->getEntrance(),

            'first_name' => $request->getFirstName(),
            'phone' => $request->getPhone()
        ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->address->update($this->attr);
    }
}
