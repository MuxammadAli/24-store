<?php

namespace App\Jobs\Dashboard\Supplier;

use App\Http\Requests\Dashboard\Supplier\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SupplierUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    private $attr;
    /**
     * @var Supplier
     */
    private $supplier;

    /**
     * Create a new job instance.
     *
     * @param SupplierRequest $req
     * @param Supplier $supplier
     *
     * @return void
     */
    public function __construct(SupplierRequest $req, Supplier $supplier)
    {
        $this->attr = $req->only('login', 'password', 'name', 'phone', 'company', 'address', 'location', 'percents');
        $this->supplier = $supplier;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
            ->put(
                env('SUPPLIERS_URL') . 'user/update/' . $this->supplier->supplier_id,
                $this->attr
            );
        abort_if(!$response->object()->status, $response->status(), $response->object());
        $this->supplier->update($this->attr);
    }
}
