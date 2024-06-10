<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payment\PaymentCreateRequest;
use App\Http\Resources\Api\Payment\PaymentIndexResource;
use App\Http\Resources\PaginateResource;
use App\Models\Agent;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index($agent)
    {
        $payments = Payment::where('agent_id', $agent)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'pagination' => new PaginateResource($payments),
            'payments' => PaymentIndexResource::collection($payments)
        ]);
    }

    public function create(PaymentCreateRequest $request)
    {
        $agent = Agent::findOrFail($request->input('agent_id'));
        DB::beginTransaction();
        try {
            Payment::create($request->only('agent_id', 'amount'));
            $agent->balance -= (int)$request->input('amount');
            $agent->save();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("PaymentController create: {$exception->getMessage()}");
        }
        DB::commit();
        return response('', 204);
    }
}
