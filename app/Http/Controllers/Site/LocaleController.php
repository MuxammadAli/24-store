<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * @param $lang
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function setLocale($lang, Request $request)
    {
        if (in_array($lang, ['ru', 'uz', 'oz'])) {
            Cookie::queue('locale', $lang, 10000000);

            return redirect()->back();
        }

        return abort(404);
    }
}
