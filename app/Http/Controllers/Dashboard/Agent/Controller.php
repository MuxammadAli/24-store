<?php

namespace App\Http\Controllers\Dashboard\Agent;

use App\Http\Controllers\Controller as ExController;
use App\Models\Agent;

class Controller extends ExController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('dashboard.agent.index', ['agents' => Agent::orderBy('id', 'desc')->paginate(20)]);
    }
}
