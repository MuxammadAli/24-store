<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    protected static $logName = 'roles';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'permissions'];
    protected static $submitEmptyLogs = false;

    public function staff()
    {
        return $this->hasOne(Staff::class, 'role_id', 'id');
    }

    public function hasPermission($type, $permissions): bool
    {
        return $this->permissions[$type][$permissions] ?? false;
    }
}
