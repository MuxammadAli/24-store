<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'dollar', 'euro', 'sum'
    ];

    protected $casts = [
        'dollar' => 'integer',
        'euro' => 'integer',
    ];
}
