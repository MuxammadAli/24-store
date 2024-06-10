<?php

namespace App\Jobs\Dashboard\CoinProduct;

use App\Models\CoinProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoinProductUpdateJob
{
    /**
     * @var CoinProduct
     */
    private $product;
    /**
     * @var array
     */
    private $attr;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $req, CoinProduct $product)
    {
        $this->attr = $req->only(
            'name',
            'body',
            'short_body',
            'price',
            'published',
            'views',
            'count',
            'available'
        );
        $this->attr['slug'] = $req->has('slug') ? Str::slug($req->get('slug')) : Str::slug($req->get('name')['ru']);
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->product->update($this->attr);
    }
}
