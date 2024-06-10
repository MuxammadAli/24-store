<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $units = Unit::get();
        return view('dashboard.units.index', compact('units'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.units.store');
        }

        Unit::create([
            'name' => $request->name,
            'count' => $request->count
        ]);

        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.units');
    }

    public function edit(Unit $unit, Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.units.edit', compact('unit'));
        }
        $unit->update([
            'name' => $request->name,
            'count' => $request->count
        ]);

        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.units');
    }

    public function delete(Unit $unit)
    {
        $unit->delete();

        $this->info(trans('admin.messages.deleted'));
        return redirect()->route('dashboard.units');
    }
}
