<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class PopularCategoryMobile extends Component
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
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
//        $categories = $this->categories->where('popular', true)->get();

        $categories = Category::latest('id')
            ->latest('id')
            ->where('popular', true)
            ->get();

        $categories->map(function ($category) {
            if ($category->parent) {
                if ($category->parent->parent) {
                    $category->link = route('category.showParent', [$category->parent->parent->slug, $category->parent->slug, $category->slug]);
                } else {
                    $category->link = route('category.show', [$category->parent->slug, $category->slug]);
                }
            } else {
                $category->link = route('category.view', $category->slug);
            }
        });

        return view('components.popular-category-mobile', compact('categories'));
    }
}
