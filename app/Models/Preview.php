<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preview extends Model
{
    protected $table = 'previews';

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'characteristics' => 'array',
        'leader_of_sales' => 'boolean',
        'popular' => 'boolean',
    ];

}
