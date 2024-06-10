<?php

namespace App\Models;

use App\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Favorite
 *
 * @property-read User $user
 * @property-read Product $product
 *
 * @mixin Model
 */
class Favorite extends Model
{

    public $timestamps = false;

    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'token'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'token' => 'string'
    ];

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
    public function product()
    {
        return $this->belongsTo(Product::class);
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
     * @return mixed
     */
    public function scopeFindByList($query)
    {
        if (auth()->check()) {
            return $query->where('user_id', auth()->user()->id);
        }

        return $query->where('token', request()->cookie('token'));
    }
}
