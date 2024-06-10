<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

    protected $table = 'partners';

    protected $fillable = [
        'name',
        'image'
    ];

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (is_file($this->image)) {
            return (string) $this->image;
        }

        return (string) 'images/no_brend.png';
    }
}
