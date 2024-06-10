<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Supplier;
use App\User;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Helpers\DashboardStatic;

use App\Http\Controllers\Controller as ExController;
use Carbon\Carbon;

class Controller extends ExController
{
    public function index()
    {
        $users = User::count();
        $orders = Order::count();
        $products = Product::count();
        $suppliers = Supplier::count();

        $statics = [
            'labels' => $this->getLabels(),
            'orders_count' => $this->getStatics(),
            'new_users' => $this->getUserStatics(),
            'transactions' => $this->getCountTransactions(),
            'credits' => $this->getCountCredit(),
            'sum' => $this->getAllSumStatic(),
        ];
        $statuses = [
            'processing' => Order::where('status', 'processing')->get()->pluck('price_product')->sum(),
            'collected' => Order::where('status', 'collected')->get()->pluck('price_product')->sum(),
            'in_way' => Order::where('status', 'in_way')->get()->pluck('price_product')->sum(),
            'cancelled' => Order::where('status', 'cancelled')->get()->pluck('price_product')->sum(),
            'closed' => Order::where('status', 'closed')->get()->pluck('price_product')->sum(),
            'today' => Order::whereIn('status', ['processing', 'collected', 'in_way', 'closed'])
                ->whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])
                ->get()
                ->pluck('price_product')
                ->sum()
        ];

        return view('dashboard.index', compact('users', 'orders', 'products', 'suppliers', 'statics', 'statuses'));
    }

    private function getLabels()
    {
        $start = now()->subDays(30);
        $days = [];
        for ($i = 0; $i <= 30; $i++) {
            $days[] = $start->copy()->addDays($i)->format('d.m');
        }
        return $days;
    }

    private function getUserStatics()
    {
        $users = DashboardStatic::getUserStatics();

//        return $users;
        return [
            'data' => [
                [
                    'name' => 'Пользователи',
                    'values' => $users
                ]
            ]
        ];
    }

    private function getStatics()
    {
        $processing = DashboardStatic::getCountProcessing();
        $collect = DashboardStatic::getCountCollected();
        $waiting = DashboardStatic::getCountInWay();
        $closed = DashboardStatic::getCountClosed();
        $cancelled = DashboardStatic::getCountCancelled();
        $replacement = DashboardStatic::getCountReplacement();
        $archived = DashboardStatic::getCountArchived();

        return [
                'data' => [
                    [
                        'name' => 'В обработке',
                        'values' => $processing
                    ],

                    [
                        'name' => 'Собран',
                        'values' => $collect
                    ],

                    [
                        'name' => 'Ожидает',
                        'values' => $waiting
                    ],

                    [
                        'name' => 'Закрыт',
                        'values' => $closed
                    ],

                    [
                        'name' => 'Отменен',
                        'values' => $cancelled
                    ],

                    [
                        'name' => 'Замена',
                        'values' => $replacement
                    ],

                    [
                        'name' => 'Архиве',
                        'values' => $archived
                    ],
                ]
        ];
    }

    private function getCountTransactions()
    {
        $payed = DashboardStatic::getSuccessTransactions();
        $waiting = DashboardStatic::getWaitingTransactions();
        $refused = DashboardStatic::getRefusedTransactions();

        return [
            'data' => [
                [
                    'name' => 'Оплачено',
                    'values' => $payed
                ],
                [
                    'name' => 'В ожидания',
                    'values' => $waiting
                ],

                [
                    'name' => 'Отказано',
                    'values' => $refused
                ],
            ]
        ];
    }

    private function getCountCredit()
    {
        $payed = DashboardStatic::getCreditPayed();
        $cancelled = DashboardStatic::getCancelledCredit();
        $review = DashboardStatic::getReviewCredit();
        $waiting = DashboardStatic::getWaitingCredit();

        return [
            'data' => [
                [
                    'name' => 'Оплачено',
                    'values' => $payed
                ],
                [
                    'name' => 'Отказано',
                    'values' => $cancelled
                ],
                [
                    'name' => 'Рассмотрение',
                    'values' => $review
                ],
                [
                    'name' => 'В ожидание',
                    'values' => $waiting
                ]
            ]
        ];
    }

    private function getAllSumStatic()
    {
        return [
            'data' => [
                [
                    'name' => 'Оплачено',
                    'values' => []
                ],
                [
                    'name' => 'Не оплачено',
                    'values' => []
                ],

                [
                    'name' => 'Отказано',
                    'values' => []
                ],
            ]
        ];
    }


}
