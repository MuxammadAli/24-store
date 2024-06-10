<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string status
 */
class OrderStatus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        switch ($this->status) {
            case 'new':
                return 'Новый';
                break;
            case 'processing':
                return 'В обработке';
                break;
            case 'collected':
                return 'Готов к доставке';
                break;
            case 'delivery':
                return 'На доставке';
                break;
            case 'closed':
                return 'Закрыт';
                break;
            case 'cancelled':
                return 'Отменен';
                break;
        }
    }

    /**
     * @return string
     */
    public function getStatusColor(): string
    {
        switch ($this->status) {
            case 'new':
                return 'success';
                break;
            case 'processing':
                return 'primary';
                break;
            case 'collected':
                return 'warning';
                break;
            case 'delivery':
                return 'info';
                break;
            case 'closed':
                return 'dark';
                break;
            case 'cancelled':
                return 'danger';
                break;
        }
    }
}
