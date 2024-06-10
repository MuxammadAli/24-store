<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index($slug)
    {
        $brand =  Brand::where('slug', $slug)->first();

        if (empty($brand)) {
            return abort(404);
        }

        $products = Product::select('id', 'name', 'poster_thumb', 'price', 'price_discount', 'popular', 'slug', 'leader_of_sales', 'currency', 'available', 'count')
            ->with('children:id,child_id')
            ->where('brand_id', $brand->id)
            ->whereHas('children')
            ->orderBy('id', 'desc')
            ->published()
            ->paginate(15);

        $products->map(function ($product) {
            $product->categories->map(function ($category) {
                if ($category->parent) {
                    if ($category->parent->parent) {
                        $category->link = route('category.showParent', [$category->parent->parent->slug, $category->parent->slug, $category->slug]);
                    } else {
                        $category->link = route('category.show', [$category->parent->slug, $category->slug]);
                    }
                } else {
                    $category->link = route('category.view', $category->slug);
                }
            });

            $product->price = $product->getPrice();
            $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();
        });

        return view('site.brand.index', compact('products', 'brand'));
    }
}
