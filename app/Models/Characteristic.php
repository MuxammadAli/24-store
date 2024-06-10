<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'name' => 'array',
        'type' => 'string',
        'options' => 'array',
        'filter' => 'boolean'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsToMany(Product::class,'characteristics_products')->withPivot('value');
    }

    public function values()
    {
        return $this->belongsToMany(Product::class,'characteristics_products')
            ->withPivot('value')
            ->select('product_id', 'value');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function filter()
    {
        return $this->belongsToMany(Category::class, 'characteristics_categories');
    }
}
