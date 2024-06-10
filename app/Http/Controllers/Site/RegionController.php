<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RegionController extends Controller
{
    public function setRegion(Request $req)
    {
        $req->validate([
            'region_id' => 'required'
        ]);
        if (!auth()->check() and !Cookie::has('region')) {
            return response(['status' => true])->cookie(cookie('region', $req->input('region_id'), 60));
        } else if (auth()->check()) {
            User::find(auth()->id())->update(['region_id' => $req->input('region_id')]);
            return response(['status' => true]);
        }
    }
}
