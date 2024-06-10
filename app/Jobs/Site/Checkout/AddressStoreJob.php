<?php

namespace App\Jobs\Site\Checkout;

use App\Models\Address;

class AddressStoreJob
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phone_other = $this->request->order['other_phone'] ? str_replace(['+', '(', ')', ' ', '-'], '', $this->request->order['other_phone']) : null;
        return Address::create([
            'user_id' => auth()->user()->id,
//            'first_name' => $this->request->order['first_name'],
//            'last_name' => $this->request->order['last_name'],
            'phone_other' => $phone_other,
            'phone' => auth()->user()->phone,
            'city' => $this->request->address['city'],
            'region' => $this->request->address['region'],
            'address' => $this->request->address['address'],
            'location' => $this->request->address['location'],
            'region_id' => $this->request->address['region_id'],
            'city_id' => $this->request->address['city_id']
        ]);
    }
}
