<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Models\Brand;
use App\Models\Category;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Category\Request as StoreRequest;
use App\Http\Requests\Dashboard\Category\Update as UpdateRequest;

use App\Jobs\Dashboard\Category\Store as StoreJob;
use App\Jobs\Dashboard\Category\Update as UpdateJob;
use App\Models\Characteristic;
use Illuminate\Http\Request;

class Controller extends ExController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'categories');
//        $categories = Category::latest()->paginate(20);
        $categories = Category::select('id', 'name->ru as category', 'position', 'parent_id', 'icon')
            ->where('parent_id', null)
            ->with(['children' => function ($parent) {
                return $parent->select('id', 'name->ru as category', 'parent_id', 'position')->orderBy('position', 'asc')->with(['children' => function ($parent) {
                    return $parent->select('id', 'name->ru as category', 'parent_id', 'position')->orderBy('position', 'asc');
                }]);
            }])->orderBy('position', 'asc')->get();
//        return Category::select('id', 'name->ru as category', 'position', 'parent_id', 'icon')->where('id', '=', 261)->with(['children' => function ($parent) {
//            return $parent->select('id', 'name->ru as category', 'parent_id', 'position')->orderBy('position', 'asc');
//        }])->first();
//        return $categories;
        return view('dashboard.category.index', compact('categories'));
    }


    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('view', 'categories');

            $brands = Brand::all();
            $brands->map(function ($brand) {
                $brand->name = $brand->name['ru'];
            });

            $parent_categories = Category::with('parent')->whereHas('parent', function ($query) {
                $query->where('parent_id', null);
            })->orWhere('parent_id', null)->orderBy('name->ru', 'asc')->get();
            return view('dashboard.category.store', compact('brands', 'parent_categories'));
        }


        $category = $this->dispatchNow(new StoreJob($request));

        if (!empty($request->char)) {
            foreach ($request->char as $char) {
                Characteristic::create([
                    'name' => $char['name'],
                    'type' => $char['type'],
                    'category_id' => $category->id,
                    'filter' => $char['filter'] == 'true' ? 1 : 0
                ]);
            }
        }

        $this->success(trans('admin.messages.created'));

        return response()->json([
            'status' => true
        ]);

        //return redirect()->route('dashboard.categories');
    }

    /**
     * @param $category
     * @param UpdateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($category, UpdateRequest $request)
    {
        $category = Category::findOrFail($category);

        if ($request->isMethod('get')) {
            $this->authorize('update', 'categories');
            $parent_categories = Category::with('parent')->whereHas('parent', function ($query) {
                $query->where('parent_id', null);
            })->orderBy('name->ru', 'asc')->whereNotIn('id', [$category->id])->get();
            $brands = Brand::all();

            $brands->map(function ($brand) {
                $brand->name = $brand->name['ru'];
            });

            $category->loadMissing(['brands', 'characteristics']);

            $category->brands->map(function ($brand) {
                $brand->name = $brand->name['ru'];
            });

            return view('dashboard.category.update', compact('parent_categories', 'category', 'brands'));
        }

        if ($request->hasFile('image')) {
            $image =  $request->file('image')->store('vendor/uploads/categories', 'local');
        } else {
            $image = $category->image;
        }

        $this->dispatchNow(new UpdateJob($category, $request, $image));

        if (!empty($request->char)) {
            foreach ($request->char as $char) {
                if ($char['id'] == null || $char['id'] == 'null') {
                    Characteristic::create([
                        'name' => $char['name'],
                        'type' => $char['type'],
                        'category_id' => $category->id,
                        'filter' => $char['filter'] == 'true' ? 1 : 0
                    ]);
                } else {
                    Characteristic::where('id', $char['id'])->update([
                        'name' => $char['name'],
                        'type' => $char['type'],
                        'filter' => $char['filter'] == 'true' ? 1 : 0
                    ]);
                }
            }
        }

        if (!empty($request->deletes['char'])) {
            Characteristic::whereIn('id', $request->deletes['char'])->delete();
        }

        $this->success(trans('admin.messages.updated'));

        return response()->json([
            'status' => true
        ]);
    }


    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete($category)
    {
        $this->authorize('delete', 'categories');
        $category = Category::findOrFail($category);
        if (isset($category->children)) {
            foreach($category->children as $children) {
                if (isset($children->children))
                foreach($children->children as $child) {
                    $child->delete();
                }
                $children->delete();
            }
        }
        $category->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function position_save(Request $request)
    {
        foreach ($request->categories as $category) {
            $cat = Category::find($category['id']);
            $cat->parent_id = $category['parent_id'] === 'null' ? null : $category['parent_id'];
            $cat->position = $category['position'];
            $cat->save();
            if (!empty($category['children'])) {
                foreach ($category['children'] as $c) {
                    $cc = Category::find($c['id']);
                    $cc->parent_id = $c['parent_id'] === 'null' ? null : $c['parent_id'];
                    $cc->position = $c['position'];
                    $cc->save();

                    if (!empty($c['children'])) {
                        foreach ($c['children'] as $ccc) {
                            $cccc = Category::find($ccc['id']);
                            $cccc->parent_id = $ccc['parent_id'] === 'null' ? null : $ccc['parent_id'];
                            $cccc->position = $ccc['position'];
                            $cccc->save();
                        }
                    }

                }
            }
        }

        $this->info(trans('admin.messages.updated'));

        return response()->json([
            'status' => true
        ]);
    }


    /**
     * @return array
     */
    public function test()
    {
        $categories = Category::select('id', 'name->ru as category')
            ->where('parent_id', null)
            ->with('parents.parents.parents')->get();

        $cat = $this->category($categories->toArray());
        $cats =  array_merge(...$cat);

        return $cats;
    }


    /**
     * @param $categories
     * @return array
     */
    private function category($categories)
    {
        return array_map(function ($cat) {
            $arr = [];

            if (count($cat['parents']) > 0) {
                $arr[] = [
                    'id' => $cat['id'],
                    'category' => $cat['name']['ru'],
                    '$isDisabled' => true
                ];

                foreach ($cat['parents'] as $parent) {
                    if (count($parent['parents']) > 0) {

                        if (count($parent['parents']) > 0) {
                            $arr[] = [
                                'id' => $parent['id'],
                                'category' => $parent['name']['ru'],
                                '$isDisabled' => true

                            ];
                            foreach ($parent['parents'] as $paren) {

                                $arr[] = [
                                    'id' => $paren['id'],
                                    'category' => $paren['name']['ru'],
                                    '$isDisabled' => false
                                ];
                            }
                        } else {
                            $arr[] = [
                                'id' => $parent['id'],
                                'category' => $parent['name']['ru'],
                                '$isDisabled' => false

                            ];
                        }

                    } else {
                        $arr[] = [
                            'id' => $parent['id'],
                            'category' => $parent['name']['ru'],
                            '$isDisabled' => false
                        ];
                    }
                }

                return $arr;
            } else {
                $arr = [
                    'id' => $cat['id'],
                    'category' => $cat['name']['ru'],
                    '$isDisabled' => false
                ];
                return $arr;
            }

        }, $categories);
    }


    /**
     * @return string
     */
    public function json()
    {
        $categories = Category::select('id', 'name', 'parent_id as parrent', 'position', 'published')->latest('id')->get();
        $data = "data ='{$categories}';";
        return $data;
    }
}
