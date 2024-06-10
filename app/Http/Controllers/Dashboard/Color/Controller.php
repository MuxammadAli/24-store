<?php

namespace App\Http\Controllers\Dashboard\Color;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Dashboard\Color\Request;
use App\Jobs\Dashboard\Color\Store;
use App\Jobs\Dashboard\Color\Update;
use App\Models\Color;

class Controller extends BaseController
{
    public function index()
    {
        $this->authorize('view', 'colors');
        $colors = Color::paginate(20);
        return view('dashboard.colors.index', compact('colors'));
    }

    public function store(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $this->authorize('create', 'categories');
            return view('dashboard.colors.create');
        }

        $this->dispatchNow(new Store($request));
        $this->success(trans('admin.messages.created'));
        return redirect()->route('dashboard.colors');
    }

    public function update(Request $request, Color $color)
    {
        if ($request->isMethod('get'))
        {
            $this->authorize('update', 'categories');
            return view('dashboard.colors.update', compact('color'));
        }

        $this->dispatchNow(new Update($request, $color));
        $this->success(trans('admin.messages.created'));
        return redirect()->route('dashboard.colors');
    }

    public function destroy(Color $color)
    {
        $this->authorize('delete', 'categories');
        $color->delete();

        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
