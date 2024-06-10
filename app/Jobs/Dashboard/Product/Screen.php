<?php

namespace App\Jobs\Dashboard\Product;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\Screen as Screens;
use App\Api\ImageResize;


class Screen
{
    protected $request;
    protected $id;
    protected $type;
    protected $img;

    /**
     * Screen constructor.
     * @param $request
     * @param $id
     * @param $type
     */
    public function __construct($request, $id, $type = 'default')
    {
        $this->request = $request;
        $this->id = $id;
        $this->img = new ImageResize();
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $folder = Carbon::now()->format('Y/m/d');
        //$folder = 'uploads/screens/'.date('Y', time()).'/'.Carbon::now()->format('m').'/'.Carbon::now()->format('d');

        foreach ($this->request as $screen) {
            $path = $screen->store("uploads/screens/original/{$folder}");
            $thumb = $this->img->resize($path, 350, 'screens');

            $screens = new Screens();
            $screens->name = basename($path);
            $screens->path = $path;
            $screens->path_thumb = $thumb;
            $screens->size = filesize($path);
            $screens->product_id = $this->id;
            $screens->product_type = $this->type;
            $screens->save();
        }
    }
}
