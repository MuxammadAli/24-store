<?php


namespace App\Helpers;


use App\Models\Category;
use App\Models\Compilation;
use App\Models\Slider;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class MainPage
{
    protected $agent;
    protected $lang;

    /**
     * MainPage constructor.
     */
    public function __construct()
    {
        $this->agent = new Agent();
        $this->lang = app()->getLocale();
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getMainProducts($type)
    {
        $newProducts = Compilation::published();

        switch ($type) {
            case 'new':
                $newProducts = $newProducts->newProducts();
                break;
            case 'popular':
                $newProducts = $newProducts->popularProducts();
                break;
            case 'lider':
                $newProducts = $newProducts->liderProducts();
                break;
            default:
                $newProducts = $newProducts->newProducts();
                break;
        }

        $newProducts = $newProducts->published()->first()->products()->published()->with('screen:id,product_id,path,path_thumb', 'unit')->withCount('comments')->isAvailable()->get(['id', 'name', 'price', 'price_discount', 'slug', 'leader_of_sales', 'available', 'count']);

        return $newProducts;
    }

    /**
     * @return mixed
     */
    public function getPopularCategories()
    {
        $popularCategories = Category::latest('id')
            ->latest('id')
            ->where('popular', true)
            ->get();

        $popularCategories->map(function ($category) {
            if ($category->parent) {
                if ($category->parent->parent) {
                    $category->link = route('category.showParent', [$category->parent->parent->id, $category->parent->parent->slug, $category->parent->id, $category->parent->slug, $category->id, $category->slug]);
                } else {
                    $category->link = route('category.show', [$category->parent->id, $category->parent->slug, $category->id, $category->slug]);
                }
            } else {
                $category->link = route('category.view', [$category->id, $category->slug]);
            }
        });

        return $popularCategories;
    }

    /**
     * @param $lang
     * @return array
     */
    public function getSliders($lang)
    {
        if ($this->agent->isMobile()) {
            if ($this->agent->isTablet()) {
                $sliders = Slider::where('language', $lang)
                    ->where('type', 'desktop')
                    ->where('placement', 'top')
                    ->published()
                    ->get();

                $middleSliders = Slider::where('language', $lang)
                    ->where('type', 'desktop')
                    ->where('placement', 'middle')
                    ->published()
                    ->get();
            } else {
                $sliders = Slider::where('language', $lang)
                    ->where('type', 'mobile')
                    ->where('placement', 'top')
                    ->published()
                    ->get();

                $middleSliders = Slider::where('language', $lang)
                    ->where('type', 'mobile')
                    ->where('placement', 'middle')
                    ->published()
                    ->get();
            }

        } else {
            $sliders = Slider::where('language', $lang)
                ->where('type', 'desktop')
                ->where('placement', 'top')
                ->published()
                ->get();

            $middleSliders = Slider::where('language', $lang)
                ->where('type', 'desktop')
                ->where('placement', 'middle')
                ->published()
                ->get();
        }

        return [$sliders, $middleSliders];
    }
}
