<?php

namespace App\Jobs\Dashboard\Region;

use App\Models\Region;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Region\Update as Request;

class Update
{

    protected $region;
    protected $attr;

    /**
     * Update constructor.
     * @param Region $region
     * @param array $attr
     */
    public function __construct(Region $region, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'cash']);
        $this->region = $region;
    }

    /**
     * @param Region $region
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Region $region, Request $request)
    {
        return new static($region, [
            'name' => $request->getName(),
            'cash' => $request->getCash()
        ]);
    }


    /**
     *
     */
    public function handle()
    {
        $this->region->update($this->attr);
    }
}
