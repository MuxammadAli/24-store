<?php

namespace App\Http\Resources;

use App\Models\Order;
use Carbon\CarbonPeriod;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class OrderPrice extends JsonResource
{
    protected  $date_from;

    protected  $date_to;

    public function __construct($date_from,$date_to)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'labels' => $this->labels(),
            'datasets' => [
                [
                    'label' =>  Order::status(0),
                    'data' => $this->prices(0),
                    'borderColor' => Order::color(0),
                    'fill' => false
                ],
                [
                    'label' =>  Order::status(1),
                    'data' => $this->prices(1),
                    'borderColor' => Order::color(1),
                    'fill' => false
                ],
                [
                    'label' =>  Order::status(2),
                    'data' => $this->prices(2),
                    'borderColor' => Order::color(2),
                    'fill' => false
                ],
                [
                    'label' =>  Order::status(3),
                    'data' => $this->prices(3),
                    'borderColor' => Order::color(3),
                    'fill' => false
                ],
                [
                    'label' =>  Order::status(4),
                    'data' => $this->prices(4),
                    'borderColor' => Order::color(4),
                    'fill' => false
                ],

            ]
        ];
    }

    public function labels(){
        $period = CarbonPeriod::create($this->date_from,$this->date_to);
        $dates =[];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }

    public function prices($status){
        $count =  Order::select(DB::raw('SUM(price_total) as price'),DB::raw('DATE(created_at) as date'))
            ->where('status',$status)
            ->groupBy('date')
            ->whereBetween('created_at',[$this->date_from,$this->date_to])
            ->pluck('price','date');
        $chart = [];
        $period = $this->labels();
        foreach ($period as $date) {
            $chart[] = (!empty($count[$date])) ? $count[$date]:0;
        }
        return $chart;
    }

}
