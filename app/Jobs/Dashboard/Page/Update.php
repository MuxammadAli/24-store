<?php

namespace App\Jobs\Dashboard\Page;

use App\Models\Page;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Page\Update as Request;

class Update
{

    protected $page;
    protected $attr;

    /**
     * Update constructor.
     * @param Page $page
     * @param array $attr
     */
    public function __construct(Page $page, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'body', 'keywords', 'descriptions']);
        $this->page = $page;
    }

    /**
     * @param Page $page
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Page $page, Request $request)
    {
        return new static($page, [
            'name' => $request->getName(),
            //'slug' => $request->name['ru'],
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
        $this->page->update($this->attr);
    }
}
