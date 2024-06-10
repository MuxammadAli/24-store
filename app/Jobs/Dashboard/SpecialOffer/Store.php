<?php

namespace App\Jobs\Dashboard\SpecialOffer;

use App\Models\SpecialOffer;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\SpecialOffer\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, [
            'name',
            'description',
            'link',
            'image'
        ]);
    }

    /**
     * @param Request $request
     * @param $path
     * @return Store
     */
    public static function fromRequest(Request $request, $path)
    {
        return new static([
            'name' => $request->getName(),
            'description' => $request->getDescription(),
            'link' => $request->getLink(),
            'image' => $path
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        SpecialOffer::create($this->attr);
    }
}
