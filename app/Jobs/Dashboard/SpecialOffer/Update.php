<?php

namespace App\Jobs\Dashboard\SpecialOffer;

use App\Models\SpecialOffer;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\SpecialOffer\Update as Request;

class Update
{

    protected $specialOffer;
    protected $attr;

    /**
     * Update constructor.
     * @param SpecialOffer $specialOffer
     * @param array $attr
     */
    public function __construct(SpecialOffer $specialOffer, array $attr = [])
    {
        $this->attr = Arr::only($attr, [
            'name',
            'description',
            'link',
            'image'
        ]);
        $this->specialOffer = $specialOffer;
    }

    /**
     * @param SpecialOffer $specialOffer
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(SpecialOffer $specialOffer, Request $request, $path)
    {
        return new static($specialOffer, [
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
        $this->specialOffer->update($this->attr);
    }
}
