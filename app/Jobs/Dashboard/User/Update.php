<?php

namespace App\Jobs\Dashboard\User;

use App\Models\Staff;
use App\User;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\User\Update as Request;

class Update
{
//    protected $attr;
    protected $staff;
    protected $request;

    /**
     * Update constructor.
     * @param User $staff
     * @param Request $request
     */
    public function __construct(Staff $staff, Request $request)
    {
        $this->staff = $staff;
        $this->request = $request;
    }

    /**
     *
     */
    public function handle()
    {
        return  $this->staff->update($this->request->validated());
    }
}
