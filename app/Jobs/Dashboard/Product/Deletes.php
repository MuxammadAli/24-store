<?php

namespace App\Jobs\Dashboard\Product;

use App\Http\Requests\Dashboard\Product\Update as Request;
use App\Models\Screen;
use App\Models\Product;

class Deletes
{

    protected $request;

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
        if ($this->request->deletes) {

            if (!empty($this->request->deletes['screens'])) {
                foreach ($this->request->deletes['screens'] as $screen) {
                    $sc = Screen::where('id', $screen)->first();
                    if (!empty($sc)) {
                        if (is_file($sc->path)) {
                            unlink($sc->path);
                        }

                        if (is_file($sc->path_thumb)) {
                            unlink($sc->path_thumb);
                        }

                        $sc->delete();
                    }
                }
            }

//            if (!empty($this->request->deletes['childrens'])) {
//                foreach ($this->request->deletes['childrens'] as $children) {
//                    $child = Product::find($children);
//                    if (!empty($child)) {
//                        $child->delete();
//                    }
//                }
//            }

        }
    }
}
