<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Cart extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'token' => 'string',
        'product_id' => 'integer',
        'count' => 'float',
        'size' => 'string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @param $query
     * @param $token
     * @return mixed
     */
    public function scopeFindByToken($query, $token)
    {
        return $query->where('token', $token);
    }

    /**
     * @param $query
     * @param $user_id
     * @return mixed
     */
    public function scopeFindByUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
