<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\View\Component;

class SinglePages extends Component
{
    public $type;

    /**
     * Create a new component instance.
     *
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $page = Page::where('type', $this->type)->first();
        return view('components.single-pages', compact('page'));
    }
}
