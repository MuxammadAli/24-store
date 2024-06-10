<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Screen
 *
 * @property string|null $name
 * @property string|null $path
 * @property string|null $path_thumb
 * @property float|null $size
 *
 * @mixin Model
 */
class Screen extends Model
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'path' => 'string',
        'path_thumb' => 'string',
        'size' => 'float',
        'product_id' => 'integer',
        'type' => 'string'
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        if (is_file($this->path)) {
            return (string) $this->path;
        }

        return (string) 'image/no_screen.png';
    }

    /**
     * @return string
     */
    public function getPathThumb(): string
    {
        if (is_file($this->path_thumb)) {
            return (string) $this->path_thumb;
        }

        return (string) 'image/no_screen_thumb.png';
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->size;
    }

}
