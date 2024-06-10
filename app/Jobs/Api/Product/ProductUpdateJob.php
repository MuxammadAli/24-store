<?php


namespace App\Jobs\Api\Product;

use App\Http\Requests\Api\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductUpdateJob
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var ProductUpdateRequest
     */
    private $request;

    /**
     * ProductUpdateJob constructor.
     * @param Product $product
     * @param ProductUpdateRequest $request
     */
    public function __construct(Product $product, ProductUpdateRequest $request)
    {
        $this->product = $product;
        $this->request = $request;
    }

    public function handle()
    {
        $this->product->update([
            'name' => $this->request->getName(),
            'body' => $this->request->getBody(),
            'slug' => $this->request->getSlug(),
            'published' => $this->request->getPublished(),
            'brand_id' => $this->request->getBrandID(),
            'unit_id' => $this->request->get('unit_id'),
            'short_body' => $this->request->get('short_body'),
            'available' => $this->request->getAvailable(),
            'descriptions' => $this->request->get('descriptions'),
            'keywords' => $this->request->get('keywords'),
            'title_seo' => $this->request->get('title_seo'),
            'search_keywords' => $this->request->get('search_keywords'),
            'entry_price' => $this->request->get('entry_price'),
            'price_percents' => $this->request->get('price_percents'),
            'discount_percents' => $this->request->get('discount_percents'),
            'images' => $this->request->get('images'),
            'agent_percents' => $this->request->get('agent_percents', 0)
        ]);
        $this->product->categories()->detach();
        $this->product->categories()->attach($this->request->input('category_id'));
    }

}
