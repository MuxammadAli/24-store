<?php

namespace App\Jobs\Dashboard\Partner;

use App\Models\Partner;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Partner\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'image']);
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
            'image' => $path
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Partner::create($this->attr);
    }
}
