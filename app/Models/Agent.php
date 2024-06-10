<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Models\Activity;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method static orderBy(string $column, string $direction = 'asc')
 * @method static create(array $attr)
 * @method static where(string $column, mixed $value, mixed $value = null)
 * @method static supplier($supplier_id)
 * @method static when(bool $has, \Closure $param)
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string patronymic
 * @property int supplier_id
 * @property string image
 * @property boolean status
 * @property int region_id
 * @property bool|mixed blocked
 * @property mixed|string name
 * @property mixed|string status_text
 * @property boolean gender
 */
class Agent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'boolean',
        'gender' => 'boolean'
    ];

    protected $hidden = ['password'];

    /**
     * @param string $username
     * @return self
     */
    public static function findByUserName(string $username): self
    {
        return self::where('username', $username)->first();
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status ? 'Online' : 'Offline';
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name . ' ' . $this->patronymic;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return (bool)$this->gender ? 'М' : 'Ж';
    }

    /**
     * @return string
     */
    public function getBlocked(): string
    {
        return (bool)$this->blocked ? 'Заблокирован' : 'Не заблокирован';
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return isset($this->image) ? '/' . $this->image : '#';
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return isset($this->image) ? env('APP_URL') . $this->image : '';
    }

    /**
     * @param $query
     * @param int $supplier_id
     */
    public function scopeSupplier($query, int $supplier_id)
    {
        $query->where('supplier_id', Supplier::where('supplier_id', $supplier_id)->first()->id);
    }

    public function scopeBlocked($query)
    {
        $query->where('blocked', '!=', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'agents_categories');
    }

    /**
     * @return mixed
     */
    public function plans()
    {
        return $this->hasMany(Plan::class)->withTrashed();
    }

    public function availableProducts()
    {
        return Category::whereIn('id', $this->categories->pluck('id'))->with('products', function ($query) {
            $query->where('supplier_id', '=', $this->supplier_id);
        })->get()->pluck('products')->flatten(1);
    }

    public function daily()
    {
        return $this->belongsToMany(
            Product::class,
            'agents_orders',
            'agent_id',
            'product_id'
        )->withPivot('count', 'created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(User::class, Activity::class, 'causer_id', 'id', 'id', 'subject_id')->where('subject_type', 'App\\Models\\User');
    }
}
