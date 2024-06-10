<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'message',
        'viewed'
    ];

    protected $casts = [
        'viewed' => 'boolean'
    ];

    protected $hidden = [
        'deteled_at'
    ];

    public function setPhoneAttribute($phone)
    {
        return $this->attributes['phone'] = str_replace(['+', '-', '(', ')', ' '], '', $phone);
    }
}
