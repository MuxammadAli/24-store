<?php

namespace App\Http\Controllers\Site;

use App\Queries\Category as Query;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    protected $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function index(Category $category, $slug)
    {
        $page = 'main';

        abort_if(!$category->published, 404);

        $characteristics = collect([]);
        list($categories, $category_id) = $this->query->getCategoriesAndCategoryMainId($category);

        $products = $this->query->getProductsFromCategoryId($category_id);
        $keywords = $category->getKeywords();
        $descriptions = $category->getDescriptions();

        return view('site.category.catalog', compact('products', 'categories', 'category', 'characteristics', 'page', 'keywords', 'descriptions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $page = 'all';
        $parents = $this->query->getCurrentCategories();

        return view('site.category.sections', compact('page', 'parents'));
    }


    /**
     * @param Category $category
     * @param $slug
     * @param Category $Category
     * @param $slug_2
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function show(Category $category, $slug, Category $Category, $slug_2)
    {
        $page = 'show';

        abort_if(!$Category->published, 404);

        list($categories, $category_id) = $this->query->getCategoriesAndCategoryId($Category);

        $products = $this->query->getProductsFromCategoryId($category_id);
        $characteristics = $this->query->getCharacteristics($Category);

        $keywords = $Category->getKeywords();
        $descriptions = $Category->getDescriptions();

        return view('site.category.catalog', compact('products', 'categories', 'category', 'Category', 'characteristics', 'page', 'keywords', 'descriptions'));
    }

    /**
     * @param Category $category
     * @param $slug
     * @param Category $cat
     * @param $slug_2
     * @param Category $Category
     * @param $slug_3
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function showCatalog(Category $category, $slug, $cat, $slug_2, Category $Category, $slug_3)
    {
        $page = 'showCatalog';

        abort_if(!$Category->published, 404);

        $products = $this->query->getCategoryProducts($Category);
        $categories = collect([]);
        $catalog = Category::findBySlug($slug_2)->firstOrFail();

        $characteristics = $this->query->getCharacteristics($catalog);

        $keywords = $Category->getKeywords();
        $descriptions = $Category->getDescriptions();

        return view('site.category.catalog', compact('products', 'category', 'categories', 'Category', 'catalog', 'page', 'characteristics', 'keywords', 'descriptions'));
    }


    /**
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Category $category, Request $request)
    {
        switch ($request->page) {
            case 'main':
                list($categories, $category_id) = $this->query->getCategoriesAndCategoryMainId($category);
                break;
            case 'show':
                list($categories, $category_id) = $this->query->getCategoriesAndCategoryId($category);
                break;
            case 'showCatalog':
                $category_id = [$category->id];
                break;
            default:
                list($categories, $category_id) = $this->query->getCategoriesAndCategoryMainId($category);
                break;
        }

        list($count, $products) = $this->query->getFilterProducts($category_id, $request);

//        return $products;

        $paginate = $request->paginate ? (int) $request->paginate : 12;

        $page = round($count / $paginate, 2) > round($count / $paginate, 0) ? round($count / $paginate + 1, 0) :  round($count / $paginate, 0);

        return response()->json([
            'count' => $count,
            'page' => $page,
            'products' => $products
        ]);
    }
}
