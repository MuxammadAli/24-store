<?php

namespace App\Models;

use App\Mail\ProductAvailable;
use App\Mail\ProductCount;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Traits\LogsActivity;


/**
 * @method static create(array $attr)
 * @property integer count
 * @property string productable_type
 * @property int|null productable_id
 */
class Product extends Model
{
    use SoftDeletes, LogsActivity;

    protected $appends = ['isFavorite', 'discountPrice', 'diffDate', 'isCart', 'isAvailable'];

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'body' => 'array',
        'short_body' => 'array',
        'slug' => 'string',
        'sizes' => 'array',
//        'poster' => 'string',
//        'poster_thumb' => 'string',

        'price' => 'float',
        'price_discount' => 'float',

        'currency' => 'string',
        'article_number' => 'integer',

        'published' => 'boolean',

        'popular' => 'boolean',
        'leader_of_sales' => 'boolean',

        //'category_id' => 'array',
        'brand_id' => 'integer',
        'color_id' => 'integer',
        //'child_id' => 'integer',
        'available' => 'boolean',
        'count' => 'integer',
        'unit_id' => 'integer',
        'keywords' => 'array',
        'descriptions' => 'array',
        'title_seo' => 'array',
        'images' => 'object',
        'agent_percents' => 'float'
    ];


    protected $hidden = [
        'deleted_at'
    ];

    protected $withCount = [
        'comments'
    ];

    protected static $logName = 'products';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'price', 'price_discount', 'article_number', 'published', 'available', 'count', 'title_seo'];
    protected static $submitEmptyLogs = false;

    protected static function booted()
    {
        static::updated(function (self $product) {
            if ($product->isDirty('count') and $product->count < 10) {
                if ($product->count !== 0 and $product->getOriginal('count') > 10) $mail = new ProductCount($product);
                else $mail = new ProductAvailable($product);
                $emails = Setting::first()->notification_emails;
                if (isset($emails)) Mail::to($emails)->send($mail);
                ProductNotification::create(['product_id' => $product->id, 'count' => $product->count]);
            }
        });
    }

    public function getName()
    {
        if (App::isLocale('ru')) {
            return (string) $this->name['ru'];
        }

        return (string) $this->name['uz'];
    }

    /**
     * @return string
     */
    public function getTitleSeo(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->title_seo['ru'];
        }

        return (string) $this->title_seo['uz'];
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->body['ru'];
        }

        return (string) $this->body['uz'];
    }

    /**
     * @return string
     */
    public function getShortBody(): string
    {
        if (App::isLocale('ru')) {
            if (!empty($this->descriptions['ru'])) {
                return (string) $this->descriptions['ru'];
            }

            return (string) $this->short_body['ru'];
        }

        if (!empty($this->descriptions['uz'])) {
            return (string) $this->descriptions['uz'];
        }

        return (string) $this->short_body['uz'];
    }


    /**
     * @return string
     */
    public function getKeywords()
    {

        if (App::isLocale('ru')) {
            if (!empty($this->keywords['ru'])) {
                $title = str_replace(' ', ', ', $this->getName());
                $keywords = $this->keywords['ru'];
                return "{$title}, {$keywords}";
            }
        }

        if (!empty($this->keywords['uz'])) {
            $title = str_replace(' ', ', ', $this->getName());
            $keywords = $this->keywords['uz'];
            return "{$title}, {$keywords}";
        }

        $title = str_replace(' ', ', ', $this->getName());
        $description = str_replace(' ', ', ', $this->getShortBody());

        return "{$title}, {$description}";
    }

    public function getRealPrice()
    {
        $prices = $this->getRegionPrice();
        return $prices[1] ?? $prices[0];
    }


    /**
     * @return float
     */
    public function getPrice()
    {
        return round($this->price * $this->getCurrency());
    }

    /**
     * @param int|null $user
     * @return array
     */
    public function getRegionPrice(int $user = null): array
    {
        if (isset($user)) $region = $this->getRegion($user);
        else $region = $this->getRegion();
        if (empty($region)) return [0, null];
        if ($this->productable_type == 'warehouse') {
            return [$region->pivot->price, $region->pivot->price_discount != 0 ? $region->pivot->price_discount : null];
        } else {
            return [$region->pivot->price, $region->pivot->price_discount];
        }
    }

    /**
     * @param int|null $user
     * @return Region|null
     */
    public function getRegion(int $user = null): ?Region
    {
        if (isset($user)) $user = User::find($user);
        $region_id = auth()->user()->region_id ?? $user->region_id ?? Cookie::get('region') ?? Setting::first()->region_id;
        return $this->regions()->where('id', '=', $region_id)->first();
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        $region = $this->getRegion();
        if (isset($region)) return $region->pivot->count;
        return 0;
    }

    /**
     * @return false|float
     */
    public function getCoins()
    {
        $price = Setting::first()->coin_price;
        if ($this->price_product > $price) {
            $i = $this->price_product / $price;
            return (int)floor($i);
        }
    }

    public function getPoster()
    {
        if (isset($this->images)) return $this->images[0]->path_thumb;
        $screen =  (object) $this->screen;
        $path = $screen->path ?? null;

        if (is_file($path)) {
            return '/'.$path;
        }

        return '/images/no_product.jpg';
    }

    public function getPosterThumb()
    {
        if (isset($this->images)) return $this->images[0]->path_thumb;
        $screen =  (object) $this->screen;
        $path = $screen->path_thumb ?? null;

        if (is_file($path)) {
            return '/'.$path;
        }

        return '/images/no_product.jpg';
    }


    /**
     * @return float
     */
    public function getDiscountPrice()
    {
        return round($this->price_discount * $this->getCurrency());
    }

    /**
     * @return float|int
     */
    public function getOnCreditAttribute()
    {
        if ($this->price_discount) {
            $price = $this->getPriceDiscount();
        } else {
            $price = $this->getPrice();
        }

        $credit = $this->pmt(0.23/12,11,$price);

        return abs($credit);

//        $credit = $price * 37 / 100 + $price;
//        return $credit / 12;
    }

    private function pmt(float $rate, int $periods, float $present_value, float $future_value = 0.0, bool $beginning = false): float
    {
        $when = $beginning ? 1 : 0;

        if ($rate == 0) {
            return - ($future_value + $present_value) / $periods;
        }

        return - ($future_value + ($present_value * pow(1 + $rate, $periods)))
            /
            ((1 + $rate * $when) / $rate * (pow(1 + $rate, $periods) - 1));
    }

    /**
     * @return int
     */
    public function getCurrency()
    {
        $currency = Currency::latest('id', 'desc')->limit(1)->first();

        if ($this->currency == 'dollar') {
            return $currency->dollar;
        } elseif ($this->currency == 'sum') {
            return 1;
        } else {
            return $currency->euro;
        }
    }

    /**
     * @return string
     */
    public function getPriceFormat()
    {
        return number_format($this->price, 0, '', ' ');
    }

    /**
     * @return int
     */
    public function getPriceDiscount(): int
    {
        return (int) $this->price_discount;
    }



    public function screen()
    {
        return $this->hasOne(Screen::class,'product_id', 'id')->orderBy('position', 'asc')->where('product_type', 'default');
    }

    /**
     * @return float|int
     */
    public function discount()
    {
        $a = $this->price;
        $b = $this->price_discount;

        $x = (($b * 100) / $a) - 100;

        return abs($x);
    }

    /**
     * @return bool
     */
    public function getDiffDate()
    {
        $original_date = date_create(Carbon::parse($this->created_at)->format('Y-m-d'));
        $now = date_create(Carbon::now()->format('Y-m-d'));
        $diff = date_diff($original_date, $now);

        if ($diff->format("%a") <= 10 ) {
            return true;
        }

        return false;
    }



    /**
     * @return array
     */
    public function getColors(): array
    {
        return $this->colors;
    }

    /**
     * @return array
     */
    public function getSizes(): array
    {
        return $this->sizes;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_products');
    }

    public function mainCategory(): ?Category
    {
        if (isset($this->categories[0])) {
            $category = $this->categories[0];
            if (isset($category->parent->parent)) {
                return $category->parent->parent;
            } elseif (isset($category->parent)) {
                return $category->parent;
            } else return $category;
        } else return null;
    }

    public function category(): ?Category
    {
        if (isset($this->categories[0])) {
            $category = $this->categories[0];
            if (isset($category->parent->parent)) return $category->parent;
            elseif (empty($category->parent->parent) and isset($category->parent)) return $category->parent;
            else return $category;
        } else return null;
    }

    public function subCategory(): ?Category
    {
        if (isset($this->categories[0])) {
            $category = $this->categories[0];
            if (isset($category->parent->parent)) return $category;
            else return null;
        } else return null;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return (string) $this->slug;
    }

    /**
     * @return bool
     */
    public function isAviable(): bool
    {
        return $this->published;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->withDefault([
            'name' => [
                'uz' => 'Brand yo`q',
                'ru' => 'Бренд нет'
            ]
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
//    public function children()
//    {
//        return $this->hasOne(self::class, 'child_id', 'id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function childrens()
//    {
//        return $this->hasMany(self::class, 'child_id', 'id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class)->where('publish', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function childrensColor()
//    {
//        return $this->hasMany(self::class, 'child_id', 'id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function screens()
    {
        return $this->hasMany(Screen::class)->orderBy('position', 'asc')->where('product_type', 'default');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
//    public function data()
//    {
//        return $this->hasOne(self::class, 'child_id', 'id');
//    }
//
//    public function product()
//    {
//        return $this->belongsTo(self::class, 'child_id', 'id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', true)->whereNull('deleted_at');
    }

//    /**
//     * @param $query
//     * @return mixed
//     */
//    public function scopeNotChilds($query)
//    {
//        return $query->whereNull('child_id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function compilations()
    {
        return $this->belongsToMany(Compilation::class, 'compilation_products');
    }

    /**
     * @param $query
     * @param $brand_id
     * @return mixed
     */
    public function scopeBrand($query, $brand_id)
    {
        return $query->where('brand_id', $brand_id);
    }

    public function getIsFavoriteAttribute()
    {
        $user = request()->user();

        if (!empty($user)) {
            $favorite = $this->belongsToMany(User::class, 'products_users')->where('user_id', $user->id)->where('product_id', $this->id)->first();

            if (!empty($favorite)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getIsAvailableAttribute()
    {
        $region_id = auth()->user()->region_id ?? Cookie::get('region') ?? Setting::first()->region_id;
        $region = $this->regions()->find($region_id);
        if (isset($region) and $region->pivot->count != 0) return true;
        return false;
    }

    /**
     * @return bool
     */
    public function getIsCartAttribute()
    {
        if (Cookie::has('cart_token'))
            $cart = !empty(Cart::where('product_id', $this->id)->findByToken(Cookie::get('cart_token'))->first()) ? true : false;
        else if (auth()->check())
            $cart = !empty(Cart::where('product_id', $this->id)->findByUser(auth()->user()->id)->first()) ? true : false;

        if (!empty($cart))
            return true;

        return false;
    }

    /**
     * @return float
     */
    public function getDiscountPriceAttribute()
    {
        $a = $this->price;
        $b = $this->price_discount;

        if (empty($b)) {
            return 0;
        }

        $x = (($b * 100) / $a) - 100;

        return round(abs($x));
    }

    /**
     * @return bool
     */
    public function getDiffDateAttribute()
    {
        $original_date = date_create(Carbon::parse($this->created_at)->format('Y-m-d'));
        $now = date_create(Carbon::now()->format('Y-m-d'));
        $diff = date_diff($original_date, $now);

        if ($diff->format("%a") <= 10 ) {
            return true;
        }

        return false;
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'characteristics_products')->withPivot(['value']);
    }

    public function scopeIsAvailable($query)
    {
        return $query->where('available', true)->where('count', '>', 0);
    }

    public function scopeIsAvailableInRegion($query, $region)
    {
        return $query->where('available', true)->leftJoin('products_regions', function ($join) use ($region) {
            $join->on('products_regions.product_id', '=', 'products.id');
            $join->where('products_regions.region_id', '=', $region);
        })->where('products_regions.count', '>', 0);
    }


    public function scopeSearchFilter($query, $id, $brand, $category, $published, $article_number, $category_id, $name)
    {
        return $query->when($id ?? null, function ($query, $id) {
                $query->where('id', $id);
            })
//            ->whereHas('brand', function ($query) use ($brand) {
//                $query->when($brand ?? null, function ($q, $brand) {
//                    $q->where('name->ru', 'like', '%'.$brand.'%');
//                });
//            })
            ->whereHas('categories', function ($query) use ($category, $category_id) {
                $query->when($category ?? null, function ($query, $category) use ($category_id) {
                    $query->whereIn('id', $category_id);
                });
            })->when($published ?? null, function ($query, $published) {
                $query->where('published', $published);
            })->when($name ?? null, function ($query, $name) {
                $query->where('name->ru', 'ilike', '%'.$name.'%');
            })->when($article_number ?? null, function ($query, $article_number) {
                $query->where('article_number', $article_number);
            });
    }

//    public function baskets()
//    {
//        return $this->belongsToMany(Basket::class, 'basket_product');
//    }

    public function unit()
    {
        return $this->belongsTo(Unit::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function regions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'products_regions')->withPivot(
            'count',
            'entry_price',
            'price_percents',
            'discount_percents',
            'price',
            'price_discount'
        );
    }

    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return empty($this->productable_type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductNotification::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }
}
