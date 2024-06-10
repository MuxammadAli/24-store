<?php

namespace App\Jobs\Dashboard\Post;

use App\Models\Post;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Post\Update as Request;

class Update
{

    protected $post;
    protected $attr;

    /**
     * Update constructor.
     * @param Post $post
     * @param array $attr
     */
    public function __construct(Post $post, array $attr = [])
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
        $this->post = $post;
    }

    /**
     * @param Post $post
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Post $post, Request $request, $path)
    {
        return new static($post, [
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
        $this->post->update($this->attr);
    }
}
