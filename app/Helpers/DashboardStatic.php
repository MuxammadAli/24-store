<?php


namespace App\Helpers;


use App\Models\Billing;
use App\Models\Order;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardStatic
{

    public static function getCountProcessing()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();


        $data = self::getCountStaticsSql('processing', $start, $now);


        return $data;
    }

    public static function getCountCollected()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = self::getCountStaticsSql('collected', $start, $now);

        return $data;
    }

    public static function getCountClosed()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = self::getCountStaticsSql('closed', $start, $now);

        return $data;
    }

    public static function getCountCancelled()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = self::getCountStaticsSql('cancelled', $start, $now);

        return $data;
    }

    public static function getCountReplacement()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = self::getCountStaticsSql('replacement', $start, $now);

        return $data;
    }

    public static function getCountArchived()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Order::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->archived(true)
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();


        $order_data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $order_data[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $order_data;
    }

    public static function getUserStatics()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $users = User::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->get();

        //$users = collect($users)->groupBy('date');

        $users = $users->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        });


        return $users;
        $data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $data[] = isset($users[$day]) ? $users[$day] : 0;
        }

        return $data;
    }

    private static function getCountStaticsSql($status, $start, $now)
    {
        $data = Order::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('status', $status)
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->archived(false)
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $order_data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $order_data[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $order_data;
    }

    public static function getCountInWay()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Order::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->whereIn('status', ['waiting_buyer', 'in_way'])
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->archived(false)
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $order_data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $order_data[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $order_data;
    }


    public static function getSuccessTransactions()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Billing::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('status', 'payed')
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $transactions = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $transactions[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $transactions;
    }

    public static function getWaitingTransactions()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Billing::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('status', 'waiting')
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $transactions = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $transactions[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $transactions;
    }

    public static function getRefusedTransactions()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Billing::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('status', 'refused')
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $transactions = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $transactions[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $transactions;
    }

    public static function getCreditPayed()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Order::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('payment_type', 'credit')
            ->where('payment_status', 'payed')
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->archived(false)
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $order_data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $order_data[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $order_data;
    }

    public static function getCancelledCredit()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Order::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('payment_type', 'credit')
            ->where('payment_status', 'cancelled')
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->archived(false)
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $order_data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $order_data[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $order_data;
    }

    public static function getReviewCredit()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Order::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('payment_type', 'credit')
            ->where('payment_status', 'review')
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->archived(false)
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $order_data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $order_data[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $order_data;
    }

    public static function getWaitingCredit()
    {
        $start = now()->subDays(30);
        $now = now()->toDateString();

        $data = Order::select(DB::raw("COUNT(id) as count"), DB::raw('DATE(created_at) as date'))
            ->where('payment_type', 'credit')
            ->where('payment_status', 'waiting')
            ->whereBetween('created_at', ["{$start->toDateString()} 00:00:01", "{$now} 23:59:59"])
            ->groupBy('date')
            ->archived(false)
            ->get();

        $data = $data->map(function ($order) {
            $array = [];
            $array[$order->date] = $order->count;

            return $array;
        })->collapse();

        $order_data = [];

        for ($i = 0; $i <= 30; $i++) {
            $day = $start->copy()->addDays($i)->toDateString();
            $order_data[] = isset($data[$day]) ? $data[$day] : 0;
        }

        return $order_data;
    }
}
