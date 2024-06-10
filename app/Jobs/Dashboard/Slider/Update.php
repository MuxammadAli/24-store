<?php

namespace App\Jobs\Dashboard\Slider;

use App\Models\Slider;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Slider\Update as Request;

class Update
{

    protected $slider;
    protected $attr;

    /**
     * Update constructor.
     * @param Slider $slider
     * @param array $attr
     */
    public function __construct(Slider $slider, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['link', 'image', 'language', 'name', 'type', 'placement', 'published']);
        $this->slider = $slider;
    }

    /**
     * @param Slider $slider
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Slider $slider, Request $request, $path)
    {
        return new static($slider, [
            'name' => $request->getName(),
            'link' => $request->getLink(),
            'image' => $path,
            'type' => $request->getType(),
            'language' => $request->getLanguage(),
            'placement' => $request->getPlacement(),
            'published' => $request->getPublished()
        ]);
    }


    /**
     *
     */
    public function handle()
    {
        $this->slider->update($this->attr);
    }
}
