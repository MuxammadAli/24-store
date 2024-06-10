<?php

namespace App\Http\Controllers\Api\Recovery;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Recovery\RecoveryIndexResource;
use App\Http\Resources\Api\Recovery\RecoveryResource;
use App\Models\Recovery;
use App\Models\Supplier;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    /**
     * @param $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($supplier): \Illuminate\Http\JsonResponse
    {
        $supplier = Supplier::where('supplier_id', $supplier)->first();
        $ids = $supplier->agents->pluck('id');
        $recoveries = Recovery::whereIn('agent_id', $ids)->get();
        return response()->json(RecoveryIndexResource::collection($recoveries)->all());
    }

    /**
     * @param Recovery $recovery
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Recovery $recovery): \Illuminate\Http\JsonResponse
    {
        return response()->json(new RecoveryResource($recovery));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        Recovery::findOrFail($request->input('recovery_id'))->update([
            'status' => $request->input('status')
        ]);
        return response('', 204);
    }
}
