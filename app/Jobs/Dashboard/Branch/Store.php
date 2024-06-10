<?php

namespace App\Jobs\Dashboard\Branch;

use App\Http\Requests\Dashboard\Branch\Request;
use App\Models\Branch;

class Store
{
    /**
     * @var $request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $request = $this->request;

        $branch = new Branch;

        $branch->name = $request->getName();
        $branch->address = $request->getAddress();
        $branch->schedule = $request->getSchedule();
        $branch->map = $request->getMap();
        $branch->phone = $request->getPhone();
        $branch->orientation = $request->getOrientation();

        $branch->save();
    }
}
