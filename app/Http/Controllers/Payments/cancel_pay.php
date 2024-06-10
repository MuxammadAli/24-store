<?php

use App\Api\Sms;
use App\Models\Billing;
use App\Models\Order;

$billing = Billing::find($transaction->transactionable_id);
$billing->status = 'refused';
$billing->save();


$sms = new Sms();

$order = Order::find($billing->order_id);
$order->status = 'cancelled';
$order->payment_status = 'cancelled';
$order->save();

$message = "Alistore vash zakaz: {$order->id} otmenen!";
$sms->send($order->user->phone, $message);
