<?php

namespace App\Jobs\Dashboard\City;

use App\Models\City;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\City\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'region_id']);
    }

    /**
     * @param Request $request
     * @param $path
     * @return Store
     */
    public static function fromRequest(Request $request)
    {
        return new static([
            'name' => $request->getName(),
            'region_id' => $request->getRegion()
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        City::create($this->attr);
    }
}
