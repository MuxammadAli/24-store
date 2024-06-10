<?php

namespace App\Http\Controllers\Dashboard\Feedback;

use App\Http\Controllers\Controller as ExController;
use App\Models\Feedback;
use Illuminate\Http\Request;

class Controller extends ExController
{
    public function index()
    {
        $this->authorize('view', 'feedback');
        $feedbacks = Feedback::latest('id')
            ->paginate(15);

        return view('dashboard.feedback.index', compact('feedbacks'));
    }

    public function show(Feedback $feedback)
    {
        $this->authorize('update', 'feedback');

        $feedback->update([
            'viewed' => true
        ]);

        return view('dashboard.feedback.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $this->authorize('delete', 'feedback');

        $feedback->delete();

        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
