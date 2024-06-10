<?php

namespace App\Http\Controllers\Api\Agent;

use App\Helpers\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Agent\AgentPlansRequest;
use App\Http\Requests\Dashboard\Agent\AgentRequest;
use App\Http\Resources\Api\Agent\AgentPlansResource;
use App\Http\Resources\Api\Agent\AgentProductsResource;
use App\Http\Resources\Api\Agent\AgentResource;
use App\Jobs\Dashboard\Agent\AgentStoreJob;
use App\Jobs\Dashboard\Agent\AgentUpdateJob;
use App\Models\Agent;
use App\Models\AgentOrder;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Region;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgentController extends Controller
{
    /**
     * @param $supplier_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $supplier_id): \Illuminate\Http\JsonResponse
    {
        $agents = Agent::supplier($supplier_id)->orderBy('id', 'desc')
            ->select('id', 'first_name', 'last_name', 'patronymic', 'phone', 'status', 'region_id', 'image', 'blocked')
            ->with('region:id,name')->withCount('orders')->get();
        $agents->map(function (Agent $agent) {
            $agent->name = $agent->getFullName();
            $agent->image = $agent->getUrl();
            $agent->makeHidden('first_name', 'last_name', 'patronymic');
            $agent->status_text = $agent->getStatus();
        });
        return response()->json(['status' => true, 'agents' => $agents]);
    }

    /**
     * @param $supplier_id
     * @param $agent
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(int $supplier_id, int $agent)//: \Illuminate\Http\JsonResponse
    {
        $agent = Agent::supplier($supplier_id)->findOrFail($agent);
        $agent->loadMissing('region');
        $agent->orders = $agent->orders()->select('id', 'user_id', 'status', 'price_product', 'created_at')
            ->with('user:id,phone')->filter()->paginate(10, ['*'], 'orders_page');
        $agent->orders->map(function (Order $order) {
            $order->status_color = $order->getStatusColor();
            $order->status = $order->getStatus();
        });

        $days = AgentOrder::where('agent_id', $agent->id)->select('created_at')->orderBy('created_at', 'desc')
            ->groupBy('created_at')->paginate(10, ['*'], 'plans_page');

        $agent->daily = (object)[
            'items' => collect([]),
            'pagination' => $days
        ];

        foreach ($days as $day) {
            $data = AgentOrder::where('agent_id', $agent->id)
                ->where('created_at', '<=', $day->created_at)
                ->selectRaw('SUM(count) as count, product_id')->groupBy('product_id')
                ->get()
                ->map(function ($daily) use ($agent, $day) {
                    $plan = AgentOrder::where('agent_id', $agent->id)->where('product_id', $daily->product_id)
                        ->where('created_at', $day->created_at)->where('count', '>', 0)->first();
                    if (empty($plan)) return false;

                    // adding previous days count
                    $count = AgentOrder::where('agent_id', $agent->id)
                            ->where('product_id', $daily->product_id)
                            ->where('created_at', '<', $day->created_at)->selectRaw('sum(count) as count, product_id')
                            ->groupBy('product_id')->first()->count ?? 0;
                    if ($count < 0) $count = 0;
                    $daily->c = $plan->count + $count;

                    if ($daily->count < $plan->count) {
                        $last = AgentOrder::where([
                            'agent_id' => $agent->id,
                            'product_id' => $daily->product_id,
                            'created_at' => $day->created_at
                        ])->where('count', '<', $plan->count)->get();
                        if (empty($last)) $daily->count = $plan->count;
                        elseif (date('Y-m-d', strtotime($day->created_at)) == date('Y-m-d'))
                            $daily->count = $plan->count - abs($last->pluck('count')->sum());
                    }
                    return $daily;
                });
            $data = $data->reject(function ($value) {
                return $value === false;
            });
            $agent->daily->items->push([
                'created_at' => date('Y-m-d', strtotime($day->created_at)),
                'data' => $data
            ]);
        }

        return response()->json(new AgentResource($agent));
    }

    /**
     * @param $supplier_id
     * @param AgentRequest $req
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function store(int $supplier_id, AgentRequest $req)
    {
        $this->dispatchNow(new AgentStoreJob($req));
        return response()->json(['status' => true], 201);
    }

    /**
     * @param $supplier_id
     * @param AgentRequest $req
     * @param $agent
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function update(int $supplier_id, AgentRequest $req, int $agent)
    {
        $agent = Agent::supplier($supplier_id)->findOrFail($agent);
        $this->dispatchNow(new AgentUpdateJob($req, $agent));
        return response()->json(['status' => true]);
    }

    public function upload(int $supplier_id, Request $request, int $agent)
    {
        $agent = Agent::supplier($supplier_id)->findOrFail($agent);
        try {
            File::delete($agent->image);
            $agent->update([
                'image' => File::upload($request->file('image'), 'agents', 200)
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . ' ' . $exception->getFile());
            return response()->json(['message' => 'Try again'], 500);
        }

        return response('', 204);
    }

    public function products(int $supplier_id, int $agent)
    {
        $agent = Agent::supplier($supplier_id)->where('id', '=', $agent)->firstOrFail();
        return response()->json(AgentProductsResource::collection($agent->availableProducts()));
    }

    public function plans(AgentPlansRequest $request, int $supplier_id, int $agent)
    {
        $agent = Agent::supplier($supplier_id)->where('id', '=', $agent)->firstOrFail();
        if ($request->isMethod('get')) {
            $plans = Plan::where('agent_id', '=', $agent->id)->with('product')->get();
            return response(AgentPlansResource::collection($plans)->all());
        }

        try {
            Plan::whereNotIn('id', array_column($request->input('plans'), 'id'))->delete();
            foreach ($request->input('plans') as $item) {
                if (isset($item['id'])) {
                    $plan = Plan::find($item['id']);
                    if ($plan->product_id != $item['product_id']) {
                        $plan->delete();
                        Plan::create([
                            'product_id' => $item['product_id'],
                            'agent_id' => $agent->id,
                            'count' => $item['count']
                        ]);
                    } elseif ($plan->count != $item['count']) {
                        $plan->update(['count' => $item['count']]);
                    }
                } else {
                    Plan::create([
                        'product_id' => $item['product_id'],
                        'agent_id' => $agent->id,
                        'count' => $item['count']
                    ]);
                }
            }
        } catch (\Exception $exception) {
            Log::error("AgentController Plans Update: {$exception->getMessage()}");
            return response(['message' => 'Something went wrong'], 500);
        }
        return response('', 204);
    }

    /**
     * @param $supplier_id
     * @param $agent
     * @return \Illuminate\Http\JsonResponse
     */
    public function block(int $supplier_id, int $agent): \Illuminate\Http\JsonResponse
    {
        $agent = Agent::supplier($supplier_id)->find($agent);
        $agent->blocked = !$agent->blocked;
        $agent->save();
        return response()->json(['status' => true, 'blocked' => $agent->blocked]);
    }
}
