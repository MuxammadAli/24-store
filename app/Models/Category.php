<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Category
 * @property string|null $name
 * @property string|null $image
 * @property string|null $slug
 * @property integer|null $id
 * @property integer|null $position
 * @property integer|null $parent_id
 * @property boolean|null $popular
 * @property boolean|null $published
 * @property int step
 *
 * @mixin Model
 */
class Category extends Model
{

    use LogsActivity, SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'array',
        'parent_id' => 'integer',
        'position' => 'integer',
        'slug' => 'string',
        'image' => 'string',
        'popular' => 'boolean',
        'published' => 'boolean',
        'keywords' => 'array',
        'descriptions' => 'array',
        'title_seo' => 'array',
        'icon' => 'string'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected static $logName = 'categories';
    protected static $logOnlyDirty = true;
    protected static $ignoreChangedAttributes = ['position'];
    protected static $logAttributes = ['name', 'parent_id', 'published', 'title_seo'];
    protected static $submitEmptyLogs = false;


    /**
     * @return int
     */
    public function getID(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * @return string|null
     */
    public function getLowerName()
    {
        return Str::lower($this->name[App::getLocale()]) ?? null;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name[App::getLocale()] ?? null;
    }

    /**
     * @return string
     */
    public function getDescriptions(): string
    {
        if (App::isLocale('ru')) {
            if (!empty($this->descriptions['ru'])) {
                return (string) $this->descriptions['ru'];
            }
        }

        if (!empty($this->descriptions['uz'])) {
            return (string) $this->descriptions['uz'];
        }

        return (string) '';
    }


    /**
     * @return string
     */
    public function getKeywords()
    {
        if (App::isLocale('ru')) {
            if (!empty($this->keywords['ru'])) {
                return $this->keywords['ru'];
            }
        }

        if (!empty($this->keywords['uz'])) {
            return $this->keywords['uz'];
        }

        return '';
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (is_file($this->image)) {
            return (string) $this->image;
        }

        return (string) 'images/no_product.jpg';
    }

    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')->where('published', true);
    }

    public function parents()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->where('published', true);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * @return string
     */
    public function getTitleSeo(): string
    {
        if (App::isLocale('ru')) {
            if(!empty($this->title_seo['ru'])) {
                return (string) $this->title_seo['ru'];
            }
        }

        if(!empty($this->title_seo['uz'])) {
            return (string) $this->title_seo['ru'];
        }

        return $this->getName();
    }


    /**
     * @return int
     */
    public function position(): int
    {
        return (int) $this->position;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'categories_brands');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'categories_products');
    }

    /**
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characteristics()
    {
        return $this->hasMany(Characteristic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function filter()
    {
        return $this->belongsToMany(Characteristic::class, 'characteristics_categories');
    }
}
