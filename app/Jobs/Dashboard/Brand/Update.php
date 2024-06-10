<?php

namespace App\Jobs\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Brand\Update as Request;

class Update
{

    protected $brand;
    protected $attr;

    /**
     * Update constructor.
     * @param Brand $brand
     * @param array $attr
     */
    public function __construct(Brand $brand, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'image', 'slug']);
        $this->brand = $brand;
    }

    /**
     * @param Brand $brand
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Brand $brand, Request $request, $path)
    {
        return new static($brand, [
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
        $this->brand->update($this->attr);
    }
}
