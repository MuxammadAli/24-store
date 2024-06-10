<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Billing extends Model
{
    use LogsActivity, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'order_id' => 'integer',
        'amount' => 'integer',
        'transaction_id' => 'string'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected static $logName = 'billings';
    protected static $recordEvents = ['deleted', 'updated'];
    protected static $logOnlyDirty = true;

    protected static $logAttributes = [
        'order_id', 'amount', 'transaction_id', 'status', 'payment_system'
    ];
    protected static $submitEmptyLogs = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
