<?php


namespace App\Exports;


use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsExport implements FromView
{
    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('dashboard.products.export', ['products' => $this->products]);
    }
}
