<?php

namespace App\Jobs\Dashboard\Partner;

use App\Models\Partner;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Partner\Update as Request;

class Update
{

    protected $partner;
    protected $attr;

    /**
     * Update constructor.
     * @param Partner $partner
     * @param array $attr
     */
    public function __construct(Partner $partner, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'image']);
        $this->partner = $partner;
    }

    /**
     * @param Partner $partner
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Partner $partner, Request $request, $path)
    {
        return new static($partner, [
            'name' => $request->getName(),
            'image' => $path
        ]);
    }


    /**
     *
     */
    public function handle()
    {
        $this->partner->update($this->attr);
    }
}
