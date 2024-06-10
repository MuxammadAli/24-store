<?php

namespace App\Jobs\Dashboard\Role;

use App\Models\Role;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Role\Request;

class Update
{
    protected $role;
    protected $attr;

    /**
     * Update constructor.
     * @param Role $role
     * @param array $attr
     */
    public function __construct(Role $role, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'permissions']);
        $this->role = $role;
    }

    /**
     * @param Role $role
     * @param Request $request
     * @param $path
     * @return Update
     */
    public static function fromRequest(Role $role, Request $request)
    {
        return new static($role, [
            'name' => $request->getName(),
            'permissions' => $request->getPermissions(),
        ]);
    }


    /**
     *
     */
    public function handle()
    {
        $this->role->update($this->attr);
    }
}
