<?php

namespace App\Http\Controllers\Api\Unit;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $req): \Illuminate\Http\JsonResponse
    {
        $lang = app()->getLocale();
        return response()->json(Unit::all('id', "name->{$lang} as title"));
    }

    /**
     * @param $unit
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($unit): \Illuminate\Http\JsonResponse
    {
        $lang = app()->getLocale();
        return response()->json(Unit::first('id', "name->{$lang} as title", 'count'));
    }
}
