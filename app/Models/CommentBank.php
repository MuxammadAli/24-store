<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentBank extends Model
{
    protected $table = 'comments_bank';

    protected $guarded = ['id'];

    protected $casts = [
        'comment' => 'string',
        'order_id' => 'integer'
    ];

}
