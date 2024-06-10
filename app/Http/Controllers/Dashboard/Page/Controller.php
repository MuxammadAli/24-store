<?php

namespace App\Http\Controllers\Dashboard\Page;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Page\Update as UpdateRequest;
use App\Http\Requests\Dashboard\Page\Store as StoreRequest;

use App\Jobs\Dashboard\Page\Store as StoreJob;
use App\Jobs\Dashboard\Page\Update as UpdateJob;
use Illuminate\Support\Carbon;

class Controller extends ExController
{

    protected $pages;

    /**
     * Controller constructor.
     * @param Brend $page
     */
    public function __construct(Page $page)
    {
        $this->pages = $page;
    }

    /**
     * @param UpdateRequest $request
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Page $page)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'pages');
            return view('dashboard.pages.edit', compact('page'));
        }

        $this->dispatchNow(UpdateJob::fromRequest($page, $request));
        $this->info(trans('admin.messages.updated'));

        return redirect()->back();
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'pages');
            return view('dashboard.pages.create');
        }

        $this->dispatchNow(StoreJob::fromRequest($request));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard');
    }

    /**
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Page $page)
    {
        $page->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function image_upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $folder = Carbon::now()->format('Y/m/d');
            $path = $request->file('file')->store("uploads/posts/{$folder}");

            return response()->json([
                'image' => $path
            ]);
        }

        return response()->json([
            'status' => false
        ], 403);
    }

    /**
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->route('dashboard');
    }
}
