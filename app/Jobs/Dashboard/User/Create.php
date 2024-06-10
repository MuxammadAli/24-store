<?php

namespace App\Jobs\Dashboard\User;

use App\Models\Staff;
use App\User;
use Illuminate\Support\Arr;
use \App\Http\Requests\Dashboard\User\Create as Request;

class Create
{
    protected $request;

    /**
     * Update constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     *
     */
    public function handle()
    {
        $user = Staff::create($this->request->validated());

        return $user;
    }
}
