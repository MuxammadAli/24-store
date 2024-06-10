<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Role\Request as UpdateRequest;
use App\Http\Requests\Dashboard\Role\Request as StoreRequest;

use App\Jobs\Dashboard\Role\Store as StoreJob;
use App\Jobs\Dashboard\Role\Update as UpdateJob;

class Controller extends ExController
{

    protected $roles;

    /**
     * Controller constructor.
     * @param Role $role
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __construct(Role $role)
    {
        $this->roles = $role;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'roles');
        $roles = $this->roles->latest('id')
            ->paginate(20);

        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * @param UpdateRequest $request
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Role $role)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'roles');
            return view('dashboard.roles.update', compact('role'));
        }

        //return $request->all();

        $this->dispatchNow(UpdateJob::fromRequest($role, $request));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.roles');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'roles');
            return view('dashboard.roles.store');
        }

        $this->dispatchNow(StoreJob::fromRequest($request));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.roles');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Role $role)
    {
        $this->authorize('delete', 'roles');
        $role->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }
}
