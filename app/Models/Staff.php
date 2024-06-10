<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class Staff extends Authenticatable
{
    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'username',
//        'email',
        'password',
        'role_id'
    ];

    protected static $logName = 'staffs';
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = [
        'username',
        'password',
        'role'
    ];

    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id')->withDefault([
            'name' => 'Удалено'
        ]);
    }

    public function hasPermission(string $type, string $permission) : bool
    {
        return $this->role->hasPermission($type, $permission);
    }

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

//    public function isModerator()
//    {
//        return $this->roles()->first()->pivot->role_id === 4;
//    }
//
//    public function isContentManager()
//    {
//        return $this->roles()->first()->pivot->role_id === 3;
//    }
}
