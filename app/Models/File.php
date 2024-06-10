<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * @property string|null $name
 * @property string|null $path
 * @property string|null $path_thumb
 * @property float|null $size
 * @mixin Model
 */
class File extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'path', 'path_thumb', 'size'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'path' => 'string',
        'path_thumb' => 'string',
        'size' => 'float'
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @return string|null
     */
    public function getPath()
    {
        if (is_file($this->path)) {
            return (string) $this->path;
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getPathThumb()
    {
        if (is_file($this->path_thumb)) {
            return (string) $this->path_thumb;
        }

        return null;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->size;
    }
}
