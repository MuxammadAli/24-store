<?php

namespace App\Http\Controllers\Dashboard\Reason;

use App\Http\Controllers\Controller as ExController;
use App\Models\Reason;
use Illuminate\Http\Request;

class Controller extends ExController
{
    public function index(Request $request)
    {
        if ($request->isMethod('get'))
            return view('dashboard.settings.reasons', ['reasons' => Reason::all()]);

        foreach ($request->input('reasons') as $reason) {
            if (empty($reason['id'])) {
                Reason::create([
                    'title' => $reason['title']
                ]);
            } else {
                Reason::find($reason['id'])->update([
                    'title' => $reason['title']
                ]);
            }
        }
        if ($request->has('deletes')) {
            Reason::whereIn('id', (array)$request->input('deletes', []))->delete();
        }
        return response('', 204);
    }
}
