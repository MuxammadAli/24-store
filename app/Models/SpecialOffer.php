<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class SpecialOffer extends Model
{
    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'link',
        'image'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array'
    ];

    protected static $logName = 'special_offer';
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = [
        'name',
        'description',
        'link',
        'image'
    ];

    public function getName(): string
    {
        return (string) $this->name[app()->getLocale()] ?? null;
    }

    public function getDescription(): string
    {
        return (string) $this->description[app()->getLocale()] ?? null;
    }

    public function getImage(): string
    {
        if (is_file($this->image)) {
            return (string) $this->image;
        }

        return (string) 'images/nophoto.png';
    }
}
