<?php

namespace App\Jobs\Dashboard\Product;

use App\Models\Product;
use App\Models\Screen;
use Carbon\Carbon;

use App\Api\ImageResize;
use Illuminate\Support\Facades\Log;


class ChildUpdate
{

    protected $product;
    protected $request;
    protected $image;
    protected $type;

    /**
     * ChildUpdate constructor.
     * @param $request
     * @param $product
     * @param string $type
     */
    public function __construct($request, $product, string $type = 'default')
    {
        $this->request = $request;
        $this->product = $product;
        $this->image = new ImageResize();
        $this->type = $type;
    }

    /**
     *
     */
    public function handle()
    {
        if (!empty($this->request->screens)) {
            $this->uploadScreen($this->request->screens, $this->product->id);
        }
    }

    /**
     * @param $screens
     * @param $child_id
     */
    private function uploadScreen($screens, $child_id)
    {
        $c = 0;
        if (!empty($screens)) {
            foreach ($screens as $screen) {
                $id = $screen['id'];
                $c++;
                if ($screen['id'] == 'undefined' || $screen['id'] == 'null' || $screen['id'] = null) {
                    $folder = Carbon::now()->format('Y/m/d');
                    if ($screen['image']) {
                        $path = $screen['image']->store("uploads/screens/{$folder}");

                        $image = Screen::create([
                            'path' => $path,
                            'path_thumb' => "uploads/screens/thumbs/{$folder}/" . basename($path),
                            'name' => basename($path),
                            'product_id' => $child_id,
                            'product_type' => $this->type,
                            'size' => filesize($path),
                            'position' => $c
                        ]);

                        $this->image->resize($image->path, 322, 'screens');
                    }
                } else {
                    $screen = Screen::find($id);

                    if (!empty($screen)) {
                        $screen->update([
                            'position' => $c
                        ]);
                    }
                }
            }
        }
    }
}
