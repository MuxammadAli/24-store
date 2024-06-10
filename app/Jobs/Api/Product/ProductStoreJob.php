<?php

namespace App\Jobs\Api\Product;

use App\Http\Requests\Api\Product\ProductStoreRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ProductStoreJob
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
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, [
            'name',
            'body',
            'price',
            'price_discount',
            'slug',
            'published',
            'brand_id',
            'unit_id',
            'short_body',
            'count',
            'available',
            'descriptions',
            'keywords',
            'title_seo',
            'search_keywords',
            'entry_price',
            'price_percents',
            'discount_percents',
            'images',
            'productable_id',
            'productable_type',
            'supplier_id',
            'agent_percents',
            'article_number'
        ]);
    }

    /**
     * @param ProductStoreRequest $req
     * @return ProductStoreJob
     */
    public static function fromRequest(ProductStoreRequest $req): ProductStoreJob
    {
        return new static([
            'name' => $req->getName(),
            'brand_id' => $req->getBrandID(),
            'price' => $req->getPrice(),
            'price_discount' => $req->getPriceDiscount(),
            'body' => $req->getBody(),
            'short_body' => $req->get('short_body'),
            'unit_id' => $req->get('unit_id'),
            'slug' => $req->getSlug(),
            'published' => $req->getPublished(),
            'count' => $req->get('count', 0),
            'available' => $req->getAvailable(),
            'keywords' => $req->get('keywords'),
            'descriptions' => $req->get('descriptions'),
            'title_seo' => $req->get('title_seo'),
            'search_keywords' => $req->get('search_keywords'),
            'entry_price' => $req->get('entry_price'),
            'price_percents' => $req->get('price_percents'),
            'discount_percents' => $req->get('discount_percents'),
            'images' => $req->get('images'),
            'productable_id' => $req->get('product_id'),
            'productable_type' => $req->get('type'),
            'supplier_id' => $req->has('supplier_id') ? Supplier::where('supplier_id', $req->input('supplier_id'))->first()->id : 0,
            'article_number' => $req->get('article_number'),
            'agent_percents' => $req->get('agent_percents') ?? 0
        ]);
    }

    /**
     * Execute the job.
     *
     * @return Product
     */
    public function handle(): Product
    {
        return Product::create($this->attr);
    }
}
