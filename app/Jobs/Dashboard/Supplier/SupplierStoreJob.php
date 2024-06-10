<?php

namespace App\Jobs\Dashboard\Supplier;

use App\Http\Requests\Dashboard\Supplier\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Support\Facades\Http;

class SupplierStoreJob
{

    /**
     * @var array
     */
    private $attr;

    /**
     * SupplierStoreJob constructor.
     * @param SupplierRequest $req
     *
     * @return void
     */
    public function __construct(SupplierRequest $req)
    {
        $this->attr = $req->only('login', 'password', 'name', 'phone', 'company', 'address', 'location', 'percents');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
            ->post(env('SUPPLIERS_URL') . 'user/store', $this->attr);
        if (empty($response->object()->status)) {
            echo $response->body();
            dd();
        }
        $this->attr['supplier_id'] = $response->object()->supplier_id;
        Supplier::create($this->attr);
    }
}
