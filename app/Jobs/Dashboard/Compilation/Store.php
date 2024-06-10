<?php

namespace App\Jobs\Dashboard\Compilation;

use App\Http\Requests\Dashboard\Compilation\Store as StoreRequest;
use App\Models\Compilation;


class Store
{

    protected $request;

    /**
     * Store constructor.
     * @param StoreRequest $request
     */
    public function __construct(StoreRequest $request)
    {
        $this->request =  $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $compilation = Compilation::create([
            'title' => $this->request->getTitle(),
            'published' => $this->request->getPublished(),
            'position' => $this->request->getPosition(),
            'category_id' => $this->request->getCategory()
        ]);

        $map = array_map(function ($product) {
            return $product['id'];
        }, $this->request->products);

        foreach ($map as $index => $id) {
            $compilation->products()->attach($id, ['position' => $index]);
        }
    }
}
