<?php

namespace App\Http\Controllers\Api\Statistics;

use App\Http\Controllers\Controller;
use App\Models\AgentOrder;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Recovery;
use App\Models\Supplier;
use Spatie\Activitylog\Models\Activity;

class StatisticsController extends Controller
{
    /**
     * @param $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function user($supplier): \Illuminate\Http\JsonResponse
    {
        $supplier = Supplier::where('supplier_id', $supplier)->firstOrFail();
        $count = Activity::where('subject_type', 'App\\Models\\User')
            ->where('description', 'created')->whereIn('causer_id', $supplier->agents->pluck('id'))->count();
        return response()->json(['count' => $count]);
    }

    /**
     * @param $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function recovery($supplier): \Illuminate\Http\JsonResponse
    {
        $supplier = Supplier::where('supplier_id', $supplier)->first();
        $ids = $supplier->agents->pluck('id');
        return response()->json(['count' => (int)Recovery::whereIn('agent_id', $ids)->count()]);
    }

    public function plan($supplier)
    {
        $supplier = Supplier::where('supplier_id', $supplier)->first();
        $agents = $supplier->agents()->whereHas('plans')->get();
        $plans_count = 0;
        if (!empty($agents)) {
            foreach ($agents as $agent) {
                $days = AgentOrder::where('agent_id', $agent->id)->select('created_at')
                    ->orderBy('created_at', 'desc')
                    ->groupBy('created_at')->get();

                foreach ($days as $day) {
                    $data = AgentOrder::where('agent_id', $agent->id)
                        ->where('created_at', '<=', $day->created_at)
                        ->selectRaw('SUM(count) as count, product_id')->groupBy('product_id')
                        ->get();

                    foreach ($data as $daily)
                        if ($daily->count < 0) $plans_count++;
                }
            }
        }
        return response()->json([
            'count' => $plans_count
        ]);
    }

    public function categories($supplier)
    {
        $supplier = Supplier::where('supplier_id', $supplier)->first();
        $categories = Category::join('categories_products', 'categories.id', '=', 'categories_products.category_id')
            ->join('products', 'categories_products.product_id', '=', 'products.id')
            ->join('order_products', 'products.id', '=', 'order_products.product_id')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [request('from'), request('to')])
            ->where('orders.status', 'closed')
            ->where('products.supplier_id', $supplier->id)
            ->selectRaw('sum(order_products.count) as count, categories.id')
            ->groupBy('categories.id')
            ->orderBy('count', 'desc')
            ->limit(3)
            ->get();
        $colors = [
            'rgba(3, 82, 252, 0.7)',
            'rgba(252, 227, 3, 0.7)',
            'rgba(252, 57, 3, 0.7)'
        ];
        return response()->json([
            'data' => json_encode([
                [
                    'label' => 'label',
                    'data' => $categories->pluck('count')->map(function ($count) {
                        return (int)$count;
                    }),
                    'backgroundColor' => $colors,
                    'hoverOffset' => 4
                ]
            ]),
            'labels' => json_encode($categories->map(function ($category) {
                return Category::find($category->id)->name['ru'];
            }))
        ]);
    }
}
