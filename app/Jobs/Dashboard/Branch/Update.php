<?php

namespace App\Jobs\Dashboard\Branch;

use App\Http\Requests\Dashboard\Branch\Request;
use App\Models\Branch;

class Update
{
    /**
     * @var $request
     */
    protected $request;

    /**
     * @var $branch
     */
    protected $branch;

    public function __construct(Request $request, Branch $branch)
    {
        $this->request = $request;
        $this->branch = $branch;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = $this->request;
        $branch = $this->branch;

        $branch->name = $request->getName();
        $branch->address = $request->getAddress();
        $branch->schedule = $request->getSchedule();
        $branch->map = $request->getMap();
        $branch->phone = $request->getPhone();
        $branch->orientation = $request->getOrientation();

        $branch->save();
    }
}
