<?php

namespace App\Http\Controllers\Dashboard\Branch;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Dashboard\Branch\Request;
use App\Jobs\Dashboard\Branch\Store;
use App\Jobs\Dashboard\Branch\Update;
use App\Models\Branch;

class Controller extends BaseController
{
    public function index()
    {
        $this->authorize('view', 'branches');
        $branches = Branch::paginate(20);
        return view('dashboard.branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $this->authorize('create', 'branches');
            return view('dashboard.branches.create');
        }

        $this->dispatchNow(new Store($request));
        $this->success(trans('admin.messages.created'));
        return redirect()->route('dashboard.branches');
    }

    public function show(Branch $branch)
    {
        $this->authorize('view', 'branches');
        return view('dashboard.branches.preview', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        if ($request->isMethod('get'))
        {
            $this->authorize('update', 'branches');
            return view('dashboard.branches.edit', compact('branch'));
        }

        $this->dispatchNow(new Update($request, $branch));
        $this->success(trans('admin.messages.created'));
        return redirect()->route('dashboard.branches');
    }

    public function destroy(Branch $branch)
    {
        $this->authorize('delete', 'branches');
        $branch->delete();
        $this->success(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
