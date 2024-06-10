<?php

namespace App\Jobs\Dashboard\Slider;

use App\Models\Slider;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Slider\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['link', 'image', 'language', 'name', 'type', 'placement', 'published']);
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
            'link' => $request->getLink(),
            'language' => $request->getLanguage(),
            'type' => $request->getType(),
            'image' => $path,
            'placement' => $request->getPlacement(),
            'published' => $request->getPublished()
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Slider::create($this->attr);
    }
}
