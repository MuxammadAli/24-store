<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Unit extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'count' => 'float'
    ];

    public function getName()
    {
        if (App::isLocale('ru')) {
            return (string) $this->name['ru'];
        }

        return (string) $this->name['uz'];
    }

}
