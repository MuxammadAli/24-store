<?php

namespace App\Http\Controllers\Dashboard\Comment;

use App\Models\Comment;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Comment\Update as UpdateRequest;

use App\Jobs\Dashboard\Comment\Update as UpdateJob;

class Controller extends ExController
{

    protected $comments;

    /**
     * Controller constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comments = $comment;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', 'comments');
        $comments = $this->comments->with('product')
            ->latest('id')->paginate(20);

        return view('dashboard.comments.index', compact('comments'));
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Comment $comment)
    {
        $this->authorize('update', 'comments');
        return view('dashboard.comments.edit', compact('comment'));
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Comment $comment)
    {
        $this->authorize('delete', 'comments');
        $comment->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }

    public function publish(Comment $comment)
    {
        $this->authorize('update', 'comments');
        $comment->update([
            'publish' => true
        ]);

        $this->info(trans('admin.messages.published'));
        return redirect()->route('dashboard.comments');
    }
}
