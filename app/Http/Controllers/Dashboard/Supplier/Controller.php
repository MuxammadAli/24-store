<?php

namespace App\Http\Controllers\Dashboard\Supplier;

use App\Http\Controllers\Controller as ExController;
use App\Http\Requests\Dashboard\Supplier\SupplierRequest;
use App\Jobs\Dashboard\Supplier\SupplierStoreJob;
use App\Jobs\Dashboard\Supplier\SupplierUpdateJob;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Controller extends ExController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('dashboard.supplier.index', [
            'suppliers' => Supplier::orderBy('id', 'desc')->paginate(20)
        ]);
    }

    /**
     * @param SupplierRequest $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(SupplierRequest $req)
    {
        if ($req->isMethod('get')) return view('dashboard.supplier.store');
        $this->dispatchNow(new SupplierStoreJob($req));
        return redirect()->route('dashboard.supplier.index')->with('success', 'Успешно добавлено!');
    }

    /**
     * @param SupplierRequest $req
     * @param Supplier $supplier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(SupplierRequest $req, Supplier $supplier)
    {
        if ($req->isMethod('get')) return view('dashboard.supplier.update', compact('supplier'));
        $this->dispatchNow(new SupplierUpdateJob($req, $supplier));
        return redirect()->route('dashboard.supplier.index')->with('success', 'Успешно отредактировано!');
    }

    /**
     * @param Supplier $supplier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(Supplier $supplier): \Illuminate\Http\RedirectResponse
    {
        Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
            ->post(env('SUPPLIERS_URL') . 'user/block/', [
                'user' => $supplier->supplier_id,
                'blocked' => !$supplier->blocked
            ]);
        $supplier->blocked = !$supplier->blocked;
        $supplier->save();
        if ($supplier->blocked) $this->error('Успешно заблокировано!');
        else $this->success('Успешно разблокировано!');
        return back();
    }
}
