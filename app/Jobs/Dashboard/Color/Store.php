<?php

namespace App\Jobs\Dashboard\Color;

use App\Http\Requests\Dashboard\Color\Request;
use App\Models\Color;

class Store
{
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = $this->request;
        
        $color = new Color;
        
        $color->name = $request->getName();
        $color->color = $request->getColor();
        
        $color->save();
    }
}
