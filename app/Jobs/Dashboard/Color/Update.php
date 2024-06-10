<?php

namespace App\Jobs\Dashboard\Color;

use App\Http\Requests\Dashboard\Color\Request;
use App\Models\Color;

class Update
{
    protected $request;
    protected $color;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     * @param Color $color
     */
    public function __construct(Request $request, Color $color)
    {
        $this->request = $request;
        $this->color = $color;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = $this->request;
        $color = $this->color;
        
        $color->name = $request->getName();
        $color->color = $request->getColor();

        $color->save();
    }
}
