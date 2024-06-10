<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Compilation;
use Illuminate\Http\Request;

class CompilationController extends Controller
{
    public function view(Compilation $compilation)
    {
        $products = $compilation->products()->select('id', 'name', 'price', 'price_discount', 'popular', 'slug', 'leader_of_sales', 'available', 'count', 'unit_id')
            ->with('screen', 'unit')
            ->withCount('comments')
            ->orderBy('products.id', 'desc')
            ->published()
            ->paginate(12);

        return view('site.compilation.view', compact('compilation', 'products'));
    }

    public function coin_product()
    {
        $compilation = Compilation::where('type', 'coin')->first();
        $products = $compilation->coin_products()->select()
            ->with('screen', 'unit')
            ->orderBy('coin_products.id', 'desc')
            ->paginate(12);

        $products->map(function ($product) {
            $product->type = 'coin';
        });
        return view('site.compilation.view', compact('compilation', 'products'));
    }

    /**
     * @param Compilation $compilation
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginate(Compilation $compilation): \Illuminate\Http\JsonResponse
    {
        $products = $compilation->products()->select('id', 'name', 'price', 'price_discount', 'popular', 'slug', 'leader_of_sales', 'available', 'count', 'unit_id')
            ->with('screen', 'unit')
            ->withCount('comments')
            ->orderBy('products.id', 'desc')
            ->published()
            ->paginate(12);
        return response()->json([
            'status' => true,
            'products' => $products
        ]);
    }
}
