<?php

namespace App\Jobs\Dashboard\Compilation;

use App\Http\Requests\Dashboard\Compilation\Update as UpdateRequest;
use App\Models\Compilation;

class Update
{

    protected $request;
    protected $compilation;

    /**
     * Update constructor.
     * @param UpdateRequest $request
     * @param Compilation $compilation
     */
    public function __construct(UpdateRequest $request, Compilation $compilation)
    {
        $this->request = $request;
        $this->compilation = $compilation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Compilation::find($this->compilation->id)->update([
            'title' => $this->request->getTitle(),
            'published' => $this->request->getPublished(),
            'category_id' => $this->request->getCategory(),
            'position' => $this->request->getPosition()
        ]);

        $detach = Compilation::find($this->compilation->id);
        if ($detach->type == 'default') {
            $detach->loadMissing(['products:id']);

            $compilation = Compilation::find($this->compilation->id);

            $map = array_map(function ($product) {
                return $product['id'];
            }, $this->request->products);

            $detach = array_map(function ($product) {
                return $product['id'];
            }, $detach->products->toArray());

            $compilation->products()->detach($detach);
            foreach ($map as $index => $id) {
                $compilation->products()->attach($id, ['position' => $index + 1]);
            }
        } else {
            $detach->loadMissing(['coin_products:id']);

            $compilation = Compilation::find($this->compilation->id);

            $map = array_map(function ($product) {
                return $product['id'];
            }, $this->request->products);

            $detach = array_map(function ($product) {
                return $product['id'];
            }, $detach->coin_products->toArray());

            $compilation->coin_products()->detach($detach);
            foreach ($map as $index => $id) {
                $compilation->coin_products()->attach($id, ['position' => $index + 1]);
            }
        }
    }
}
