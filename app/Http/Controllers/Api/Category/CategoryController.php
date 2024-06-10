<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Category\CategoryParentsResource;
use App\Http\Resources\Api\Category\CategoryResource;
use App\Http\Resources\Api\Category\CategorySubCategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $lang = app()->getLocale();
        $categories = Category::when($request->has('categories'), function ($query) use ($request) {
            $query->whereIn('id', $request->input('categories'));
        })->select('id', "name->{$lang} as title", 'parent_id')->get();
        $categories->map(function (Category $category) {
            if (isset($category->parent)) {
                if (isset($category->parent->parent)) $category->step = 3;
                else $category->step = 2;
            } else $category->step = 1;
            $category->makeHidden('parent');
        });
        return response()->json($categories);
    }

    public function list()
    {
        $categories = Category::orderBy('name->ru', 'asc')
            ->whereDoesntHave('parent')
            ->get();
        return response()->json(CategoryResource::collection($categories));
    }

    public function show($id)
    {
        $category = Category::where('id', '=', $id)->select('id', 'name->ru as category', 'parent_id')->with(['parent' => function ($parent) {
            return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents:id,name->ru as category,parent_id', 'parent' => function ($parent) {
                return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents' => function ($parent) {
                    return $parent->select('id', 'name->ru as category', 'parent_id');
                }]);
            }]);
        }])->first();
        return response($category);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function subCategories()
    {
        $categories = Category::whereDoesntHave('children')->whereHas('parent', function ($query) {
            $query->where('deleted_at', null)->whereHas('parent', function ($query) {
            $query->where('deleted_at', null);
        } )->where('deleted_at', null);
        } )->where('deleted_at', null)->select('id', 'name', 'parent_id')->get();
        return response()->json(CategorySubCategoriesResource::collection($categories)->all());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function parents(): \Illuminate\Http\JsonResponse
    {
        $categories = Category::orderBy('name->ru', 'asc')
            ->whereDoesntHave('parent')
            ->get();
        return response()->json([
            'status' => true,
            'categories' => CategoryParentsResource::collection($categories)
        ]);
    }
}
