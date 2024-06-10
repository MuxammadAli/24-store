<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\Site\Feedback\Create as CreateRequest;

class FeedbackController extends Controller
{
    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        Feedback::create($request->validated());

        $this->info('success');
        return redirect()->back();
    }
}
