<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersComment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'orders_comments';

    protected $hidden = [
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(Staff::class, 'user_id', 'id');
    }
}
