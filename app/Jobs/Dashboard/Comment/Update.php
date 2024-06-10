<?php

namespace App\Jobs\Dashboard\Comment;

use App\Models\Comment;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Comment\Update as Request;

class Update
{

    protected $comment;
    protected $attr;

    /**
     * Update constructor.
     * @param Comment $comment
     * @param array $attr
     */
    public function __construct(Comment $comment, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['publish']);
        $this->comment = $comment;
    }

    /**
     * @param Comment $comment
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Comment $comment, Request $request)
    {
        return new static($comment, [
            'publish' => $request->getPublish(),
            'user_id' => auth()->user()->id
        ]);
    }


    /**
     *
     */
    public function handle()
    {
        $this->comment->update($this->attr);
    }
}
