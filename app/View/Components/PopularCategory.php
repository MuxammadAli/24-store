<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class PopularCategory extends Component
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
        $categories = $this->categories->where('popular', true)->get();
        return view('components.popular-category', compact('categories'));
    }
}
