<?php

namespace App\Http\Controllers\Dashboard\Notification;

use App\Api\Firebase;
use App\Models\Notification;
//use App\Models\Notification as Model;
use App\Models\NotificationAvailable;
//use App\User;
use Illuminate\Http\Request;

//use App\Api\Firebase;
//use App\Models\Firebase as Model;
use App\Http\Controllers\Controller as ExController;


class Controller extends ExController
{

    protected $firebase;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->firebase = new Firebase();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $notifications = Notification::latest()->paginate(20);
        return view('dashboard.notifications.index', compact('notifications'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $lang = $request->lang;
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'lang' => 'required',
        ]);

        Notification::create([
            'title' => $request->title,
            'body' => $request->body,
            'language' => $request->lang
        ]);

//        $tokens = Model::whereHas('user', function($user) use ($lang) {
//            $user->where('language', $lang)->where('notification', true);
//        })->get()->map(function ($firebase) {
//            return $firebase->token;
//        });

        $notification = [
            'title' => $request->title,
            'body' => $request->body
        ];

        $this->firebase->send_all($notification);

        return redirect()->back()->with(trans('admin.messages.created'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notification_available()
    {
        $notifications = NotificationAvailable::groupBy('product_id')->select('product_id')->with('product')->selectRaw('count(id) as count')->get();

        return view('dashboard.notifications.alertNotification', compact('notifications'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notification_available_view($id)
    {
        $notifications = NotificationAvailable::where('product_id', $id)->get();

        return view('dashboard.notifications.alertView', compact('notifications'));
    }
}
