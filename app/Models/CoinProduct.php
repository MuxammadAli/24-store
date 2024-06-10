<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property array name
 * @property array body
 * @property array short_body
 * @property boolean available
 * @method static create(array $attr)
 */
class CoinProduct extends Model
{
    use SoftDeletes, LogsActivity;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'body' => 'array',
        'short_body' => 'array',
        'published' => 'boolean',
        'available' => 'boolean',
        'seo' => 'array',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        $lang = app()->getLocale();
        return $this->name[$lang] ?? $this->name['ru'] ?? '';
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        $lang = app()->getLocale();
        return $this->body[$lang] ?? $this->body['ru'] ?? '';
    }

    /**
     * @return string
     */
    public function getShortBody(): string
    {
        $lang = app()->getLocale();
        return $this->short_body[$lang] ?? $this->short_body['ru'] ?? '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearchFilter($query, $id, $brand, $category, $published, $article_number, $category_id, $name)
    {
        return $query->when($id ?? null, function ($query, $id) {
            $query->where('id', $id);
        })
            ->whereHas('category', function ($query) use ($category, $category_id) {
                $query->when($category ?? null, function ($query, $category) use ($category_id) {
                    $query->whereIn('id', $category_id);
                });
            })->when($published ?? null, function ($query, $published) {
                $query->where('published', $published);
            })->when($name ?? null, function ($query, $name) {
                $query->where('name->ru', 'ilike', '%'.$name.'%');
            });
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        if (isset($this->screens[0])) return '/'.$this->screens[0]->path_thumb;
        return '/images/no_product.jpg';
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return (bool)$this->available;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function screens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Screen::class, 'product_id')->orderBy('position', 'asc')->where('product_type', 'coin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function screen(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Screen::class,'product_id', 'id')->orderBy('position', 'asc')->where('product_type', 'coin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function getTitleSeo()
    {
        $lang = app()->getLocale();
        return $this->seo ? $this->seo->title->$lang ?? $this->seo->title->ru ?? '' : '';
    }

    public function getKeywords()
    {
        $lang = app()->getLocale();
        return $this->seo ? $this->seo->keywords->$lang ?? $this->seo->keywords->ru ?? '' : '';
    }
}
