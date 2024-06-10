<?php

namespace App\Jobs\Dashboard\CoinProduct;

use App\Models\CoinProduct;
use App\Models\Compilation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoinProductStoreJob
{
    /**
     * @var array
     */
    private $attr;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $req)
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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = CoinProduct::create($this->attr);
        Compilation::where('type', 'coin')->first()->coin_products()->attach($product->id);
        return $product;
    }
}
