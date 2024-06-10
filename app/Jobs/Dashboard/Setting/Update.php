<?php

namespace App\Jobs\Dashboard\Setting;

use App\Models\Setting;
use Illuminate\Support\Arr;

use App\Http\Requests\Dashboard\Setting\Update as Request;


class Update
{
    protected $attr;
    protected $setting;

    /**
     * Update constructor.
     * @param Setting $setting
     * @param array $attr
     */
    public function __construct(Setting $setting, array $attr = [])
    {
        $this->attr = Arr::only($attr, [
            'title',
            'address',
            'email',
            'phone',
            'socials',
            'keywords',
            'description',
            'landmark',
            'notification_emails',
            'coin_price',
            'region_id'
        ]);
        $this->setting = $setting;
    }

    /**
     * @param Setting $setting
     * @param Request $request
     * @return Update
     */
    public static function fromRequest(Setting $setting, Request $request){
        return new static($setting, [
            'title' => $request->getTitle(),
            'address' => $request->getAddress(),
            'keywords' => $request->getKeywords(),
            'description' => $request->getDescription(),
            'email' => $request->getEmail(),
            'phone' => $request->getPhone(),
            'socials' => $request->getSocials(),
            'landmark' => $request->getLandmark(),
            'notification_emails' => $request->input('notification_emails'),
            'coin_price' => $request->input('coin_price'),
            'region_id' => $request->input('region_id')
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        $this->setting->update($this->attr);
    }
}
