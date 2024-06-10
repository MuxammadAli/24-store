<?php

namespace App\Jobs\Dashboard\Product;


use App\Http\Requests\Dashboard\Product\Update as Request;
use App\Models\Category;
use App\Models\NotificationAvailable;
use App\Models\Product;
use Illuminate\Support\Arr;

class Update
{

    protected $attr;
    protected $request;
    protected $product;

    /**
     * Update constructor.
     * @param Product $product
     * @param Request $request
     */
    public function __construct(Product $product, Request $request)
    {
        $this->product = $product;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $this->product->update([
            'name' => $this->request->getName(),
            //'category_id' => $request->getCategoryID(),
            'brand_id' => $this->request->getBrandID(),

//            'currency' => $this->request->currency,

            'price' => $this->request->getPrice(),
            'price_discount' => $this->request->getPriceDiscount(),

//            'poster' => $this->request->getPoster(),
//            'poster_thumb' => $this->request->getPosterThumb(),

            'body' => $this->request->getBody(),
            'short_body' => $this->request->short_body,
            'unit_id' => $this->request->unit_id,

            'slug' => $this->request->getSlug(),
            'published' => $this->request->getPublished(),
            'popular' => $this->request->getPopular(),
            'leader_of_sales' => $this->request->getLeaderOfSales(),

            'article_number' => $this->request->article_number,
            'count' => $this->request->count,
            'available' => $this->request->getAvailable(),
            'keywords' => $this->request->keywords,
            'descriptions' => $this->request->descriptions,
            'title_seo' => $this->request->title_seo,
            'search_keywords' => $this->request->search_keywords,
            'entry_price' => $this->request->entry_price,
            'price_percents' => $this->request->price_percents,
            'discount_percents' => $this->request->discount_percents
        ]);

        $product = $this->product->fresh();

        $cats = $this->product->categories()->get();

        $cats = array_map(function ($cat) {
            return $cat['id'];
        }, $cats->toArray());

        if ($this->request->count > 0 && $this->request->getAvailable()) {
            NotificationAvailable::where('product_id', $this->product->id)->update([
                'sms' => 0
            ]);
        }

        $product->categories()->detach($cats);
        $product->categories()->attach([$this->request->getCategoryID()]);

        return $product;
    }
}
