<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * Class Color
 * @property string|null $name
 * @property string|null $color
 * @mixin
 */
class Color extends Model
{
    protected $table = 'colors';

    protected $fillable = [
        'name', 'color'
    ];

    protected $casts = [
        'name' => 'array',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getName(): string
    {
        return (string) $this->name[App::getLocale()] ?? null;
    }

    public function getColor(): string
    {
        return (string) $this->color;
    }
}
