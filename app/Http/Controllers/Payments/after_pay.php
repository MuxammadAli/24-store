<?php

use App\Models\Billing;
use App\Models\Order;
use App\Api\Sms;

$billing = Billing::find($transaction->transactionable_id);
$billing->status = 'payed';
$billing->transaction_id = $transaction->system_transaction_id;
$billing->save();


$sms = new Sms();

$order = Order::find($billing->order_id);
$order->payment_status = 'payed';
$order->save();

$message = "Alistore vash zakaz: {$order->id} uspeshno oplachen!";
$sms->send($order->user->phone, $message);
