<?php

namespace App\Jobs\Dashboard\Product;

use App\Models\Compilation;
use App\Models\Product;
use App\Models\Screen;
use Carbon\Carbon;
use App\Api\ImageResize;

use Illuminate\Support\Facades\Log;


class Child
{

    protected $request;
    protected $image;
    protected $product;
    protected $type;


    /**
     * Child constructor.
     * @param $request
     * @param $product
     */
    public function __construct($request, $product, $type = 'default')
    {
        $this->request = $request;
        $this->product = $product;
        $this->image = new ImageResize();
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $c = 1;
        if (!empty($this->request->screens)) {
            foreach ($this->request->screens as $screen) {
                $c++;
                $folder = Carbon::now()->format('Y/m/d');
                $path = $screen['image']->store("uploads/screens/{$folder}");

                $image = Screen::create([
                    'path' => $path,
                    'path_thumb' => "uploads/screens/thumbs/{$folder}/" . basename($path),
                    'name' => basename($path),
                    'product_id' => $this->product->id,
                    'product_type' => $this->type,
                    'size' => filesize($path),
                    'position' => $c
                ]);

                $this->image->resize($image->path, 322, 'screens');
            }
        }

    }
}
