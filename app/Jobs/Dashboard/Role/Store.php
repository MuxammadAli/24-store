<?php

namespace App\Jobs\Dashboard\Role;

use App\Models\Role;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Role\Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'permissions']);
    }

    /**
     * @param Request $request
     * @param $path
     * @return Store
     */
    public static function fromRequest(Request $request)
    {
        return new static([
            'name'          => $request->getName(),
            'permissions'   => $request->getPermissions(),
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Role::create($this->attr);
    }
}
