<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Firebase extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'token'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'token' => 'string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
