<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Setting
 *
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $description
 * @property array|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property array|null $socials
 *
 * @mixin Model
 */
class Setting extends Model
{

    use LogsActivity;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'title' => 'array',
        'keywords' => 'array',
        'description' => 'array',
        'phone' => 'array',
        'address' => 'array',
        'socials' => 'array',
        'email' => 'string',
        'day_delivery' => 'integer',
        'price_delivery' => 'integer',
        'landmark' => 'array',
        'permissions' => 'array',
        'pickup_text' => 'array',
        'other' => 'array',
        'links' => 'array',
        'buy_one' => 'boolean',
        'notification_emails' => 'array'
    ];

    protected static $logName = 'settings';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'title', 'keywords', 'description', 'phone', 'address', 'socials', 'email', 'day_delivery', 'price_delivery',
        'landmark', 'permissions', 'pickup_text', 'other', 'pickup', 'delivery', 'buy_one'
    ];
    protected static $submitEmptyLogs = false;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->title['ru'];
        }

        return (string) $this->title['uz'];
    }


    /**
     * @return string
     */
    public function getKeywords(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->keywords['ru'];
        }

        return (string) $this->keywords['uz'];
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->description['ru'];
        }

        return (string) $this->description['uz'];
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->address['ru'];
        }

        return (string) $this->address['uz'];
    }

    /**
     * @return string
     */
    public function getLandmark()
    {
        if (App::isLocale('ru')) {
            return (string) $this->address['ru'];
        }

        return (string) $this->address['uz'];
    }

    /**
     * @return int
     */
    public function getPriceDelivery()
    {
        return (int) $this->price_delivery;
    }

    public function getDayDelivery()
    {
        return (int) $this->day_delivery;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return (string) $this->phone['default'];
    }

    /**
     * @return string
     */
    public function getPhoneOther(): string
    {
        return (string) $this->phone['other'];
    }



    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->email;
    }

    /**
     * @return string
     */
    public function getTelegram(): string
    {
        return (string) $this->socials['telegram'];
    }

    /**
     * @return string
     */
    public function getFacebook(): string
    {
        return (string) $this->socials['facebook'];
    }

    /**
     * @return string
     */
    public function getInstagram(): string
    {
        return (string) $this->socials['instagram'];
    }

    /**
     * @return string
     */
    public function getYoutube()
    {
        return (string) $this->socials['youtube'];
    }

    /**
     * @return string
     */
    public function getOkru()
    {
        return (string) $this->socials['okru'];
    }

}
