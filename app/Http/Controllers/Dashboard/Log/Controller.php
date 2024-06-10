<?php

namespace App\Http\Controllers\Dashboard\Log;

use App\Http\Controllers\Controller as ExController;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class Controller extends ExController
{

    public function index(Request $request)
    {
        $this->authorize('view', 'logs');

        $date_from = $request->date_from;
        $description = $request->description;
        $user_id = $request->user_id;
        $log_name = $request->log_name;
        $id = $request->subject_id;

        $logs = Activity::where('causer_type', 'App\Models\Staff')
            ->with(['causer'])
            ->whereNotIn('log_name', ['sliders', 'billings'])
//            ->whereHasMorph('subject', '*', function ($query, $type) {
//                Log::info($type);
//                if ($type === Product::class) {
//                    return $query->where('price', '>', 0);
//                }
//            })
            ->latest();

        if (!is_null($date_from)) {
                $date_from = Carbon::parse($date_from)->format('Y-m-d 00:00:01');

                $date_to = Carbon::now()->format('Y-m-d 23:59:59');

                $logs = $logs->whereBetween('created_at', [$date_from, $date_to]);
        }

        if (!is_null($description))
            $logs = $logs->where('description', $description);

        if (!is_null($user_id))
            $logs = $logs->where('causer_id', $user_id);

        if (!is_null($log_name))
            $logs = $logs->where('log_name', $log_name);

        if (!is_null($id))
            $logs = $logs->where('subject_id', $id);

        $logs = $logs->paginate(50);

        return view('dashboard.logs.index', compact('logs'));
    }
}
