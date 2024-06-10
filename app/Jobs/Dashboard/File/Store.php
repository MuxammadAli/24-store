<?php

namespace App\Jobs\Dashboard\File;

use App\Models\File;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\File\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'path', 'size']);
    }

    /**
     * @param Request $request
     * @param $size
     * @param $path
     * @return Store
     */
    public static function fromRequest(Request $request, $path, $size)
    {
        return new static([
            'name' =>  $request->file('file')->getClientOriginalName(),
            'size' => $size,
            'path' => $path
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        File::create($this->attr);
    }
}
