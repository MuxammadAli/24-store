<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Exports\UsersExport;
use App\Http\Requests\Dashboard\User\Create as CreateRequest;
use App\Imports\UsersImport;
use App\Jobs\Dashboard\User\Create;
use App\Models\Role;
use App\Models\Staff;
use App\User;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\User\Update as UpdateRequest;

use App\Jobs\Dashboard\User\Update as UpdateJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Controller extends ExController
{
    protected $users;

    /**
     * Controller constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->users = $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'users');
        if ($request->get('direction') === 'asc') $direction = 'desc';
        else $direction = 'asc';
        $users = $this->users->orderBy($request->get('column', 'id'), $request->get('direction', 'desc'));

        if (!is_null($request->date_from)) {
            $users = $users->filterByDate($request->date_from, $request->date_to, $request->sort_type);
        }

//        return $users->get();
        $users = $users->search($request->search_id, $request->search_phone, $request->search_ip)->paginate(30);

//        return $users;

        return view('dashboard.users.index', compact('users', 'direction'));
    }

    public function getStaffs()
    {
        $this->authorize('view', 'staffs');

        $staffs = Staff::with('role')
            ->oldest('id')
            ->where('role_id', '!=' ,2)
            ->paginate(30);

        return view('dashboard.users.staffs', compact('staffs'));
    }

    /**
     * @param Staff $staff
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function block(Staff $staff)
    {
        $this->authorize('update', 'staffs');

        if ($staff->block === true) {
            $staff->block = false;

        } else {
            $staff->block = true;
        }

        $staff->save();

        $this->info(trans('admin.messages.updated'));
        return redirect()->back();
    }

    public function store(CreateRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'staffs');
            $roles = Role::whereNotIn('id', [2])->get();
            return view('dashboard.users.create', compact('roles'));
        }

        $this->dispatchNow(new Create($request));

        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.staffs');
    }

    /**
     * @param UpdateRequest $request
     * @param Staff $staff
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Staff $staff)
    {
        if ($request->isMethod('get')) {

            $this->authorize('update', 'staffs');

            $roles = Role::whereNotIn('id', [2])->get();
            return view('dashboard.users.update', compact('staff', 'roles'));
        }
        $this->dispatchNow(new UpdateJob($staff, $request));

        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.staffs');
    }

    public function import()
    {
        $file = '/customers.csv';

        $excel = Excel::toArray(new UsersImport, $file);

        $users = collect($excel)->flatten(1);

        foreach ($users as $user) {
            $phone = str_replace(['+', '(', ')', ' ', '-'], '', $user[8]);
            $user = User::where('phone', $phone)->first();
            if (empty($user)) {
                if (!empty($user[8])) {
                    User::create([
                        'first_name' => !empty($user[4]) ? $user[4] : null,
                        'last_name' => !empty($user[5]) ? $user[5] : null,
                        'phone' => str_replace(['+', '(', ')', ' ', '-'], '', $user[8]),
                        'email' => !empty($user[7]) ? $user[7] : null,
                        'ip' => !empty($user[17]) ? $user[17] : null,
                        'role_id' => 2,
                        'step' => 3
                    ]);
                }
            }

        }
    }

    public function export(Request $request)
    {
//        return $request;
        return (new UsersExport($request->date_from, $request->date_to, $request->search_id, $request->search_phone, $request->search_ip, $request->sort_type))
            ->download("users_".now()->toDateString().".xlsx");
    }

    public static function addHours()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->update([
                'created_at' => $user->created_at->addHours(5)
            ]);
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view(User $user)
    {
        $orders = $user->orders()->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.users.view', compact('user', 'orders'));
    }
}
