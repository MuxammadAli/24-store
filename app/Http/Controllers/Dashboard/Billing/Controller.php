<?php

namespace App\Http\Controllers\Dashboard\Billing;

use App\Http\Controllers\Controller as ExController;
use App\Models\Billing;
use Illuminate\Http\Request;

class Controller extends ExController
{
    public function index()
    {
        $this->authorize('view', 'billings');
        $billings = Billing::latest('id')
            ->paginate(config(50));

        return view('dashboard.billing.index', compact('billings'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $id = $request->get('query');
        $billings = Billing::where('id', $id)->orWhere('transaction_id', $id)->paginate(50);

        return view('dashboard.billing.index', compact('billings'));

    }

    public function status(Billing $billing, string $status)
    {
        $billing->update(['status' => $status]);
        $this->info(trans('admin.messages.updated'));
        return back();
    }
}
