<?php

namespace App\Http\Controllers\Dashboard\File;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\File\Store as StoreRequest;
use App\Jobs\Dashboard\File\Store as StoreJob;

class Controller extends ExController
{

    protected $files;

    /**
     * Controller constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->files = $file;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', 'files');

        $files = $this->files->latest('id')->paginate(20);
        return view('dashboard.files.index', compact('files'));
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', 'files');

        $path = $request->file('file')->store('uploads/files');
        $size = filesize($path);

        $this->dispatchNow(StoreJob::fromRequest($request, $path, $size));

        $this->success(trans('admin.messages.updated'));
        return redirect()->back();
    }

    /**
     * @param File $file
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(File $file)
    {
        $this->authorize('delete', 'files');

        if (is_file($file->path)) {
            unlink($file->path);
        }

        $file->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
