<?php

namespace App\Jobs\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Brand\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'image', 'slug']);
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
            'image' => $path,
            'slug' => str_slug($request->name['ru'])
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Brand::create($this->attr);
    }
}
