<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property mixed pivot
 */
class Region extends Model
{

    use LogsActivity, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'cash' => 'boolean'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected static $logName = 'regions';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'cash'];
    protected static $submitEmptyLogs = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'region_id', 'id');
    }

    public function getName(): string
    {
        return (string) $this->name[App::getLocale()] ?? '#';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_regions');
    }
}
