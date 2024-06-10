<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use LogsActivity, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'body' => 'array',
        'keywords' => 'array',
        'descriptions' => 'array',
    ];

    protected static $logName = 'pages';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'body'];
    protected static $submitEmptyLogs = false;

    public function getName(): string
    {
        return (string) $this->name[app()->getLocale()] ?? null;
    }

    public function getBody(): string
    {
        return (string) $this->body[app()->getLocale()] ?? null;
    }

    public function getDescriptions()
    {
        if (App::isLocale('ru')) {
            return $this->descriptions['ru'];
        }

        return $this->descriptions['uz'];
    }

    public function getKeywords()
    {
        if (App::isLocale('ru')) {
            return $this->keywords['ru'];
        }

        return $this->keywords['uz'];
    }
}
