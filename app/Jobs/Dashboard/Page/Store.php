<?php

namespace App\Jobs\Dashboard\Page;

use App\Models\Page;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Page\Store as Request;
use Illuminate\Support\Str;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'body', 'slug', 'keywords', 'descriptions']);
    }

    /**
     * @param Request $request
     * @param $path
     * @return Store
     */
    public static function fromRequest(Request $request)
    {
        return new static([
            'name' => $request->getName(),
            'slug' => Str::slug($request->name['ru']),
            'body' => $request->getBody(),
            'keywords' => $request->keywords,
            'descriptions' => $request->descriptions
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        $page = Page::create($this->attr);

        $lastPage = Page::latest('id')->first();

        $page->update([
            'type' => $lastPage->type + 1
        ]);
    }
}
