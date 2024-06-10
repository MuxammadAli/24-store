<?php

namespace App\Jobs\Dashboard\City;

use App\Models\City;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\City\Update as Request;

class Update
{

    protected $city;
    protected $attr;

    /**
     * Update constructor.
     * @param City $city
     * @param array $attr
     */
    public function __construct(City $city, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'region_id']);
        $this->city = $city;
    }

    /**
     * @param City $city
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(City $city, Request $request)
    {
        return new static($city, [
            'name' => $request->getName(),
            'region_id' => $request->getRegion()
        ]);
    }


    /**
     *
     */
    public function handle()
    {
        $this->city->update($this->attr);
    }
}
