<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        'first_name',
        'body',
        'user_id',
        'product_id',
        'publish'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'body' => 'string',
        'first_name' => 'string',
        'created_at' => 'datetime:H:i d.m.Y',
        'publish' => 'boolean',
    ];

    protected $hidden = [
        'update_at', 'user_id', 'product_id', 'deleted_at'
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
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
