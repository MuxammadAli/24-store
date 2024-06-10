<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoriesHeader extends Component
{
    protected $categories;

    /**
     * Create a new component instance.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->categories = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     * @throws \Exception
     */
    public function render()
    {
        $categories = $this->categories->with(['parents' => function ($parent) {
                    return $parent->select('id', 'name', 'parent_id', 'slug', 'published', 'image', 'position')
                            ->orderBy('position', 'asc')->with(['parents' => function ($parent) {
                                return $parent->select('id', 'name', 'parent_id', 'slug', 'published', 'position')
                                        ->orderBy('position', 'asc');
                            }]);
                }])
                ->orderBy('position', 'asc')
                ->whereNull('parent_id')
                ->where('published', true)
                ->get(['id', 'name', 'slug', 'image', 'icon']);

        $categories->map(function ($category) {
            $category->hover = false;
        });


        return view('components.categories-header', compact('categories'));
    }
}
