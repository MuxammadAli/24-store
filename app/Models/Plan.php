<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'daily_plans';

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::created(function (self $plan) {
            AgentOrder::create([
                'agent_id' => $plan->agent_id,
                'product_id' => $plan->product_id,
                'count' => $plan->count
            ]);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
