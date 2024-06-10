<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
{
    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'language',
        'link',
        'type',
        'placement',
        'published'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];


    protected static $logName = 'sliders';
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = [
        'name',
        'image',
        'language',
        'link',
        'type',
        'placement',
        'published'
    ];

    public function getImage(): string
    {
        if (is_file($this->image)) {
            return $this->image;
        }

        return '/images/nophoto.jpg';
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
