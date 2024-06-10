<?php

namespace App\Jobs\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Category\Update as Request;

class Update
{

    protected $request;
    protected $category;
    protected $image;


    /**
     * Update constructor.
     * @param Category $category
     * @param Request $request
     * @param $image
     */
    public function __construct(Category $category, Request $request, $image)
    {
        $this->category = $category;
        $this->request = $request;
        $this->image = $image;
    }

    public function handle()
    {
        $request = $this->request;
        $category = $this->category;

        $category->name = $request->getName();
        $category->slug = $request->getSlug();
        $category->position = $request->getPosition();
        //$category->image = $request->getImage();
        $category->parent_id = $request->getParentId();
        $category->popular = $request->getPopular();
        $category->published = $request->getPublished();
        $category->descriptions = $request->descriptions;
        $category->keywords = $request->keywords;
        $category->title_seo = $request->title_seo;
        $category->icon = $request->getIcon();

        $category->image = $this->image;

        $category->save();

        if (isset($request->brands)) {
            $category->brands()->syncWithoutDetaching($request->brands);
        } else {
            $category->brands()->sync(array());
        }
    }
}
