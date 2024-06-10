<?php

namespace App\Jobs\Dashboard\Region;

use App\Models\Region;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Region\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'cash', 'region_id']);
    }

    /**
     * @param Request $request
     * @param $region_id
     * @return Store
     */
    public static function fromRequest(Request $request, $region_id): Store
    {
        return new static([
            'name' => $request->getName(),
            'cash' => $request->getCash(),
            'region_id' => $region_id
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Region::create($this->attr);
    }
}
