<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;


/**
 * Class Branch
 * @property array|null $name
 * @property array|null $address
 * @property array|null $schedule
 * @property string|null $map
 * @property string|null $phone
 * @property array|null $orientation
 * @mixin Model
 */

class Branch extends Model
{
    use SoftDeletes;

    protected $table = 'branches';

    protected $fillable = [
        'name', 'address', 'schedule', 'map', 'phone', 'orientation'
    ];

    protected $casts = [
        'name' => 'array',
        'address' => 'array',
        'schedule' => 'array',
        'map' => 'array',
        'orientation' => 'array',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name[App::getLocale()] ?? null;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address[App::getLocale()] ?? null;
    }

    /**
     * @return mixed
     */
    public function getSchedule()
    {
        return $this->schedule[App::getLocale()] ?? null;
    }

    public function getLat(): string
    {
        return (string) $this->map['lat'];
    }

    public function getLong(): string
    {
        return (string) $this->map['long'];
    }

    public function getPhone(): string
    {
        return (string) $this->phone;
    }
}
