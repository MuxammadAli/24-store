<?php

namespace App\Jobs\Dashboard\Post;

use App\Models\Post;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Post\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, [
            'name',
            'content',
            'topped',
            'language',
            'image',
            'type',
            'keywords',
            'descriptions'
        ]);
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
            'content' => $request->getBody(),
            'topped' => $request->getTopped(),
            'language' => $request->getLanguage(),
            'image' => $path,
            'type' => $request->getType(),
            'keywords' => $request->keywords,
            'descriptions' => $request->descriptions
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Post::create($this->attr);
    }
}
