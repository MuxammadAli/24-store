<?php

namespace App\Models;

use App\User;
use App\Models\City;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Address
 * @property string|null $address
 * @property string|null $apartment
 * @property string|null $first_name
 * @property string|null $street
 * @property string|null $floor
 * @property string|null $entrance
 * @property integer|null $phone
 *
 * @property-read User $user
 * @property-read City $city
 *
 * @mixin Model
 */
class Address extends Model
{

    use LogsActivity, SoftDeletes;
    //use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'city_id' => 'integer',
        'phone' => 'integer',
        'first_name' => 'string',
        'region' => 'string',
        'street' => 'string',
        'apartment' => 'string',
        'floor' => 'string',
        'entrance' => 'string',
        'location' => 'array'
    ];

    protected static $logName = 'addresses';
    protected static $recordEvents = ['deleted', 'updated'];
    protected static $logOnlyDirty = true;

    protected static $logAttributes = [
        'user_id', 'city_id', 'first_name', 'phone', 'phone_other', 'street', 'apartment', 'floor', 'entrance'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFirstName(): string
    {
        return (string) $this->first_name;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return (string) $this->street;
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return (int) $this->phone;
    }


    /**
     * @return string
     */
    public function getFloor(): string
    {
        return (string) $this->floor;
    }

    /**
     * @return string
     */
    public function getEntrance(): string
    {
        return (string) $this->entrance;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        if (isset($this->city_id)) return (string) $this->cityy->getName();
        return $this->city ?? '';
    }

    public function getRegion()
    {
        if (isset($this->region_id)) return $this->regionn->getName();
        return $this->region ?? '';
    }

    /**
     * @return string
     */
    public function getApartment(): string
    {
        return (string) $this->apartment;
    }

    public function getUrl()
    {
        return "https://maps.yandex.com/?pt={$this->location['lng']}, {$this->location['lat']}&ll={$this->location['lng']}, {$this->location['lat']}&z=19";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regionn(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cityy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

}
