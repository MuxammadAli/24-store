<?php

namespace App\Jobs\Api\Product;

use App\Http\Requests\Api\Product\ProductRegionRequest;
use App\Models\Product;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionAttachJob
{
    /**
     * @var Request
     */
    private $req;


    /**
     * RegionAttachJob constructor.
     * @param ProductRegionRequest $req
     */
    public function __construct(ProductRegionRequest $req)
    {
        $this->req = $req;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->req->input('type') == 'supplier') {
            $region = Region::where('id', '=', $this->req->input('region'))->first();
            $product = Product::where('productable_id', '=', $this->req->input('product'))->first();
        }
        else {
            $region = Region::where('region_id', '=', $this->req->input('region'))->first();
            $product = Product::find($this->req->input('product'));
        }
        $product->regions()->attach($region->id, [
            'entry_price' => $this->req->input('entry_price'),
            'count' => $this->req->input('count'),
            'price' => $this->req->input('price') ?? $this->req->input('price_percents'),
            'price_discount' => $this->req->input('price_discount') ?? $this->req->input('discount_percents')
        ]);
    }
}
