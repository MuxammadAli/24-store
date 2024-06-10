<?php

namespace App\Http\Controllers\Api\Region;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Region::orderBy('id', 'desc')->select('id', 'name->ru as title')->get());
    }

    /**
     * @param Request $req
     * @return Region[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $req)
    {
        return $req->has('regions') ? Region::whereIn('id', $req->input('regions'))->get() : Region::all();
    }

    /**
     * @param Region $region
     * @return Region
     */
    public function view(Region $region): Region
    {
        return $region;
    }
}
