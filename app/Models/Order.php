<?php

namespace App\Models;

use App\Api\Telegram;
use App\Mail\OrderCreated;
use App\User;
use App\Models\Address;
use App\Models\OrderProducts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Order
 *
 * @property int id
 * @property string|null $comment
 * @property integer|null $amount
 * @property-read User $user
 * @property-read Address $address
 * @property-read Collection|OrderProducts[] $products
 * @property mixed status
 * @property mixed price_product
 *
 * @mixin Model
 * @method static find(int $id)
 */
class Order extends Model
{

    use LogsActivity, SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'address_id' => 'integer',
        'price_product' => 'float',
        'price_delivery' => 'float',
        'discount' => 'float',
        'type_delivery' => 'string',
        'status' => 'string',
        'payment_type' => 'string',
        'comment' => 'string',
        'branch_id' => 'integer',
        'payment_status' => 'string',
        'currency' => 'array',
        'type' => 'string',
        'apelsin_data' => 'array',
    ];

    protected static function booted()
    {
        static::created(function (self $order) {
            if ($order->payment_type === 'cash') {
                $order->payment_type = 'Наличка';
            }
            if ($order->payment_type === 'transfer') {
                $order->payment_type = 'Перечисление';
            }
            $price = number_format($order->price_product, 0, '', ' ');
            $phone = $order->user->getPhone();
            $route = env('APP_URL') . "dashboard/orders/view/" . $order->id;
            $mail = new OrderCreated($order);
//            $emails = Setting::first()->notification_emails;
//            if (isset($emails)) Mail::to($emails)->send($mail);
//            Telegram::sendMessage(
//                "*Новый заказ*\n\n🆔ID: {$order->id}\n\n💳Тип оплаты: {$order->payment_type}\n\n💰Цена: {$price} сум\n\n📞Телефон: +{$phone}\n\n[Посмотреть на сайте]({$route})"
//            );
        });
        static::updated(function (self $order) {
            if (isset($order->agent_id) and $order->status == 'closed') {
                $agent = $order->agent;
                $sum = [];
                foreach ($order->products as $product) {
                    $plan = $agent->plans()->where('product_id', $product->product_id)->first();
                    if (isset($plan)) {
                        AgentOrder::create([
                            'agent_id' => $agent->id,
                            'product_id' => $product->product_id,
                            'count' => -$product->count
                        ]);
                    }
                    $price = !empty($product->product->getRegionPrice()[1]) ? $product->product->getRegionPrice()[1] : $product->product->getRegionPrice()[0];
                    $sum[] = (($price * $product->count) * $product->product->agent_percents) / 100;
                }
                $agent->balance += array_sum($sum);
                $agent->save();
            }
        });
    }

    protected static $logName = 'orders';
    protected static $logOnlyDirty = true;

    protected static $logAttributes = ['status'];
    protected static $submitEmptyLogs = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id')->withTrashed();
    }

    /**
     * @return mixed|string
     */
    public function getRegion()
    {
        if (isset($this->address)) {
            return $this->address->getRegion();
        }
        return $this->user->region->getName() ?? '';
    }

    /**
     * @return mixed|string
     */
    public function getAddress()
    {
        if (isset($this->address)) {
            return $this->address->getRegion() . ', ' . $this->address->getCity();
        }
        return $this->user->address;
    }

    /**
     * @return mixed|string
     */
    public function getFirstName()
    {
        if (isset($this->first_name)) {
            return $this->first_name;
        }
        return $this->user->getFirstName();
    }

    /**
     * @return mixed|string
     */
    public function getLastName()
    {
        if (isset($this->first_name)) {
            return $this->first_name;
        }
        return $this->user->getLastName();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(OrdersComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments_bank()
    {
        return $this->hasMany(CommentBank::class);
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return (int)$this->price_product;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return (string)$this->comment;
    }


    public function billing()
    {
        return $this->hasOne(Billing::class, 'order_id', 'id');
    }


    public function products()
    {
        return $this->hasMany(OrderProducts::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class)->withTrashed();
    }


    /**
     * @param $query
     * @param $token
     * @return mixed
     */
    public function scopeFindByToken($query, $token)
    {
        return $query->where('token', $token);
    }

    public static function status($status)
    {
        switch ($status) {
            case 1;
                return 'Оформлено';
            case 2;
                return 'Доставляется';
            case 3;
                return 'Доставлено';
            case 4;
                return 'Отменено';
            default:
                return 'Обработка';

        }
    }

    public function getStatus(): string
    {
        switch ($this->status) {
            case 'new':
                return 'Новый';
            case 'processing':
                return 'В обработке';
            case 'collected':
                return 'Готов к доставке';
            case 'delivery':
                return 'На доставке';
            case 'closed':
                return 'Закрыт';
            case 'cancelled':
                return 'Отменен';
            default:
                return '';
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
            case 'processing':
                return 'primary';
            case 'collected':
                return 'warning';
            case 'delivery':
                return 'info';
            case 'closed':
                return 'dark';
            case 'cancelled':
                return 'danger';
            default:
                return '';
        }
    }

    public function scopeArchived($query, $bool)
    {
        return $query->where('archived', $bool);
    }

    public static function color($color)
    {
        switch ($color) {
            case 1;
                return '#FF9F43';
            case 2;
                return '#7367F0';
            case 3;
                return '#28C76F';
            case 4;
                return '#EA5455';
            default:
                return '#1E1E1E';

        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderStatus::class);
    }

    public function getCoins()
    {
        $coin_price = Setting::first()->coin_price;
        if ($this->price_product > $coin_price) {
            $i = $this->price_product / $coin_price;
            $coins = $this->user->coins;
            return floor($i);
        }
        return 0;
    }

    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->id <= env('OLD_ORDER_ID');
    }

    public function scopeFilter($query)
    {
        $query->when(request('column', 'id') !== 'phone', function ($query) {
            $query->orderBy(request('column', 'id'), request('direction', 'desc'));
        })->when(request('status', 'all') != 'all', function ($query) {
            $query->where('status', request('status'));
        })->when(request('phone') != null, function ($query) {
            $query->join('users', 'orders.user_id', '=', 'users.id')->where('users.phone', request('phone'))->select('orders.*');
        });
    }

}
