<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Compilation
 * @property string|null $title
 * @property integer|null $position
 * @property integer|null $category_id
 * @property boolean|null $published
 * @mixin Model
 */
class Compilation extends Model
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'position', 'published', 'category_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'array',
        'position' => 'integer',
        'published' => 'boolean',
        'category_id' => 'integer'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title['ru'];
    }

    /**
     * @return bool
     */
    public function isAviable(): bool
    {
        return $this->published;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'compilation_products')
            ->withPivot('position')
            ->where('published', true)->orderByPivot('position', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function coin_products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CoinProduct::class, 'compilation_coin_products', 'compilation_id', 'coin_product_id')
            ->withPivot('position')
            ->where('published', true)->orderByPivot('position', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeCategory($query, $id)
    {
        return $query->where('category_id', $id);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeNewProducts($query)
    {
        return $query->where('id', 3);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePopularProducts($query)
    {
        return $query->where('id', 2);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLiderProducts($query)
    {
        return $query->where('id', 1);
    }

}
