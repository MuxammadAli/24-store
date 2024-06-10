<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StockController extends Controller
{
    public function index(Request $request)
    {
//        $products = $this->helper->getSearchProduct($request->name, $request->post('order_by') ?? null);

        $products = Product::select('id', 'name', 'price', 'price_discount', 'popular', 'slug', 'leader_of_sales', 'count', 'available', 'unit_id')
                ->whereNotNull('price_discount')
                ->with('screen', 'unit')
                ->withCount('comments')
                ->published();

        $order_by = $request->post('order_by') ?? null;

        if ($order_by) {
            switch ($order_by) {
                case 'new':
                    $products = $products->latest();
                    break;
                case 'cheap':
                    $products = $products->orderByRaw('COALESCE(price_discount, price) ASC');
                    break;
                case 'expensive':
                    $products = $products->orderByRaw('COALESCE(price_discount, price) DESC');
                    break;
            }
        }

        $products = $products->paginate(15);

        if ($request->ajax()) {
            return response()->json($products);
        }

//                ->orderBy('id', 'desc')

//        $products->map(function ($product) {
//            $product->categories->map(function ($category) {
//                if ($category->parent) {
//                    if ($category->parent->parent) {
//                        $category->link = route('category.showParent', [$category->parent->parent->slug, $category->parent->slug, $category->slug]);
//                    } else {
//                        $category->link = route('category.show', [$category->parent->slug, $category->slug]);
//                    }
//                } else {
//                    $category->link = route('category.view', $category->slug);
//                }
//            });
//
//            $product->price = $product->getPrice();
//            $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();
//        });

//        return $products;

//        $sales = Post::where('type', 'sales')
//            ->where('language', app()->getLocale())->get();
//
//        $sales->map(function ($post) {
//            $post->date = $post->getDatePublic();
//        });

        return view('site.stocks.index', compact('products'));
    }
}
