<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Exports\ProductsExport;
use App\Helpers\MassAction;
use App\Imports\MobileImport;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Preview;
use App\Models\Screen;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Queries\Category as CategoryQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ExController;

use App\Http\Requests\Dashboard\Product\Store as StoreRequest;
use App\Http\Requests\Dashboard\Product\Update as UpdateRequest;

use App\Jobs\Dashboard\Product\Store as StoreJob;
use App\Jobs\Dashboard\Product\Child as ScreenStoreJob;
use App\Jobs\Dashboard\Product\ChildUpdate as ScreenUpdateJob;
use App\Jobs\Dashboard\Product\Update as UpdateJob;

//use App\Jobs\Dashboard\Product\Screen as ScreenJob;
use App\Jobs\Dashboard\Product\Deletes as DeletesJob;
use Maatwebsite\Excel\Facades\Excel;

class Controller extends ExController
{

    protected $products;
    protected $categories;
    protected $brands;
    protected $colors;
    protected $categoryQuery;
    /**
     * @var MassAction
     */
    private $massAction;

    /**
     * Controller constructor.
     * @param Product $product
     * @param Category $category
     * @param Brand $brand
     * @param Color $color
     */
    public function __construct(Product $product, Category $category, Brand $brand, Color $color)
    {
        $this->products = $product;
        $this->categories = $category;
        $this->brands = $brand;
        $this->colors = $color;
        $this->categoryQuery = new CategoryQuery();
        $this->massAction = new MassAction();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'products');
//        $products = $this->products->latest('id')->paginate($request->paginate ?? 15);
        $products = $this->products->orderBy($request->get('column', 'id'), $request->get('direction', 'desc'))->paginate($request->paginate ?? 15);
        $categories = Category::whereNull('parent_id')->get();
        if ($request->get('direction') === 'asc') $direction = 'desc';
        else $direction = 'asc';
        $export_categories = Category::with('parent')->orderBy('name->ru', 'asc')->get();
        $export_categories->map(function (Category $category) {
            $category->category = $category->getName();
        });
        $products->map(function (Product $product) {
            [$product->price, $product->price_discount] = $product->getRegionPrice();
            $product->count = $product->getCount();
        });

        return view('dashboard.products.index', compact('products', 'categories', 'direction', 'export_categories'));
    }

    /**
     * @param StoreRequest $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'products');
            $categories = $this->categories->select('id', 'name->ru as category')
                ->where('parent_id', null)
                ->with(['parents' => function ($parent) {
                    return $parent->select('id', 'name->ru as category', 'parent_id')->orderBy('category', 'asc')->with(['parents' => function ($parent) {
                        return $parent->select('id', 'name->ru as category', 'parent_id')->orderBy('category', 'asc');
                    }]);
                }])->orderBy('category', 'asc')->get();


            $brands = $this->brands->get();
            $colors = $this->colors->get();
            $units = Unit::all();

            return view('dashboard.products.store', compact('categories', 'brands', 'colors', 'units'));
        }


        $product = $this->dispatchNow(StoreJob::fromRequest($request));

//        return $product->toArray();
        $product->categories()->attach([$request->getCategoryID()]);

//        return $request->all();

        $this->charSync($product, $request->characteristics);

        $this->dispatchNow(new ScreenStoreJob($request, $product));

        $this->success(trans('admin.messages.created'));

        return response()->json([
            'status' => true
        ]);
    }


    /**
     * @param $product
     * @param $char
     */
    private function charSync($product, $char)
    {
        $sync_data = [];

        if (!empty($char)) {
            $ids = collect($char)->map(function ($char) {
                return (int)$char['id'];
            });

            $product->characteristics()->detach($ids);

            for ($i = 0; $i < count($char); $i++) {
                if ($char[$i]['value']) {
                    $sync_data[$char[$i]['id']] = ['value' => $char[$i]['value']];
                }
            }

            $product->characteristics()->attach($sync_data);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function characteristics($id)
    {
        $category = Category::find($id);


        if (!empty($category->parent)) {
            $characteristics = $category->parent->characteristics;
        } else {
            $characteristics = $category->characteristics;
        }

        if (empty($characteristics)) {
            $characteristics = $category->characteristics;
        }

        $characteristics->map(function ($characteristic) {
            if ($characteristic->type == 'checkbox') {
                $characteristic->value = false;
            } else {
                $characteristic->value = null;
            }
        });

        return [
            'status' => true,
            'characteristics' => $characteristics
        ];
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


    public function update(Product $product, UpdateRequest $request)
    {
        if ($request->isMethod('get')) {

            $this->authorize('update', 'products');

            $product->loadMissing([
                'categories' => function ($categories) {
                    return $categories->select('id', 'name->ru as category', 'parent_id')->with(['parent' => function ($parent) {
                        return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents', 'parent' => function ($parent) {
                            return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents' => function ($parent) {
                                return $parent->select('id', 'name->ru as category', 'parent_id');
                            }]);
                        }, 'parents' => function ($parent) {
                            return $parent->select('id', 'name->ru as category', 'parent_id');
                        }]);
                    }]);
                },

                'screens',
                'characteristics',
                'unit'
            ]);


            $product->screens->map(function ($screen) {
                $screen->sizeText = $screen->size / 1024 . 'Kb';
                $screen->url = '/' . $screen->path;
                $screen->type = "image/jpeg";

                return $screen;
            });

            $categories = $this->categories->select('id', 'name->ru as category')
                ->where('parent_id', null)
                ->with(['parents' => function ($parent) {
                    return $parent->select('id', 'name->ru as category', 'parent_id')->with(['parents' => function ($parent) {
                        return $parent->select('id', 'name->ru as category', 'parent_id');
                    }]);
                }])->get();

            $brands = $this->brands->get();
            $colors = $this->colors->get();
            $units = Unit::all();

            return view('dashboard.products.update', compact('categories', 'brands', 'colors', 'product', 'units'));
        }

//        return $request->all();

        $this->dispatchNow(new UpdateJob($product, $request));

        $this->dispatchNow(new ScreenUpdateJob($request, $product));

        $this->charSync($product, $request->characteristics);

        $this->dispatchNow(new DeletesJob($request));
        $this->info(trans('admin.messages.updated'));

        return response()->json([
            'status' => true
        ]);
    }


    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Product $product)
    {
        $this->authorize('delete', 'products');
//        if (is_file($product->poster)) {
//            unlink($product->poster);
//        }
//
//        if (is_file($product->poster_thumb)) {
//            unlink($product->poster_thumb);
//        }
//
//        $screens = Screen::where('product_id', $product->id)->get();
//        foreach ($screens as $screen) {
//            if (is_file($screen->path)) {
//                unlink($screen->path);
//            }
//
//            if (is_file($screen->path)) {
//                unlink($screen->path_thumb);
//            }
//
//            $screen->delete();
//        }
//
//        foreach ($product->childrens as $children) {
//            $screens = Screen::where('product_id', $children->id)->get();
//            foreach ($screens as $screen) {
//                $this->delete_screen($screen);
//            }
//            $children->delete();
//        }

        $product->notifications()->delete();
        $product->delete();
//        $product->childrens()->delete();

        $this->error(trans('admin.messages.deleted'));
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $id = empty($request->get('id')) ? null : $request->get('id');
        $brand = empty($request->get('brand')) ? null : $request->get('brand');
        $name = empty($request->get('name')) ? null : $request->get('name');
        $category = empty($request->get('category')) ? null : $request->get('category');
        $in_stock = empty($request->get('in_stock')) && $request->get('in_stock') == 0 ? null : $request->get('in_stock');
        $published = empty($request->get('published')) ? null : $request->get('published');
        $article_number = empty($request->get('article_number')) ? null : $request->get('article_number');

        if ($category) {
            $categoryFind = Category::find($category);
            list($categoryFind, $category_id) = $this->categoryQuery->getCategoriesAndCategoryMainId($categoryFind);
        } else {
            $category_id = [];
        }

        if ($in_stock) {
            $products = Product::orderBy($request->get('column', 'id'), $request->get('direction', 'desc'))->searchFilter($id, $brand, $category, $published, $article_number, $category_id, $name);

            if ($in_stock == 1) {
                $products = $products->where('available', 1)->where('count', '>', 0);
            }

        } else {
            $products = Product::orderBy($request->get('column', 'id'), $request->get('direction', 'desc'))->searchFilter($id, $brand, $category, $published, $article_number, $category_id, $name);

            if ($in_stock == 0) {
                $products = $products->where('available', 0)->where('count', '>', 0)
                    ->orWhere('available', 1)->where('count', 0)->searchFilter($id, $brand, $category, $published, $article_number, $category_id, $name)
                    ->orWhere('available', 0)->where('count', 0)->searchFilter($id, $brand, $category, $published, $article_number, $category_id, $name);
            }
        }

        $products = $products->paginate(10);

        $products->map(function (Product $product) {
            $product->count = $product->getCount();
            [$product->price, $product->price_discount] = $product->getRegionPrice();
        });

        $categories = Category::whereNull('parent_id')->get();

        if ($request->get('direction') === 'asc') $direction = 'desc';
        else $direction = 'asc';

        $export_categories = Category::with('parent')->orderBy('name->ru', 'asc')->get();
        $export_categories->map(function (Category $category) {
            $category->category = $category->getName();
        });

        return view('dashboard.products.index', compact('products', 'categories', 'direction', 'export_categories'));
    }

    /**
     * @param Screen $screen
     * @return array
     * @throws \Exception
     */
    public function delete_screen(Screen $screen)
    {
        if (is_file($screen->path)) {
            unlink($screen->path);
        }

        if (is_file($screen->path_thumb)) {
            unlink($screen->path_thumb);
        }

        $screen->delete();

        return ['status' => true];
    }

    public function import(Request $request)
    {
        if ($request->isMethod('get')) {
            $categories = Category::whereNull('parent_id')->get();
            return view('dashboard.products.import', compact('categories'));
        }

        $file = $request->file('file')->store('uploads/imports');

        $excel = Excel::toArray(new MobileImport, $file);

        $excel = collect($excel)->flatten(1)->map(function ($product) {
            if ($product[0] != null) {
                return $product;
            }
        })->filter(function ($value) {
            return $value != null;
        })->splice(1);

        Preview::query()->truncate();

//        foreach ($excel as $product) {
//            Preview::create([
//                'name' => [
//                    'ru' => $product[0],
//                    'uz' => $product[1],
//                ],
//
//                'brand' => $product[2],
//                'price' => $product[3] ? $product[3] : 0,
//                'price_discount' => $product[4],
//                'article_number' => $product[5],
//                'leader_of_sales' => $product[6],
//                'popular' => $product[7],
//                'category_id' => $request->category_id,
//
//                'characteristics' => [
//                    $product[8],
//                    $product[9],
//                    $product[10],
//                    $product[11],
//                    $product[12],
//                    $product[13],
//                    $product[14],
//                    $product[15],
//                    $product[16],
//                    $product[17],
//                ]
//            ]);
//        }

        foreach ($excel as $product) {
            $price = intval(str_replace(' ', '', rtrim($product[3], ' сум')));
            $price_discount = intval(str_replace(' ', '', rtrim($product[3], ' сум')));
            Preview::create([
                'id' => $product[0],
                'name' => [
                    'ru' => $product[1],
                    'uz' => $product[1]
                ],
                'price' => $price,
                'price_discount' => $price_discount !== 0 ? $price_discount : null,
                'category_id' => $request->category_id,
            ]);
        }

        $products = Preview::all();

        $characteristics = $this->characteristics($request->category_id);

        $category_id = $request->category_id;

        return view('dashboard.products.preview', compact('products', 'characteristics', 'category_id'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function previewStore(Request $request)
    {
        $char = $this->characteristics($request->category_id);

        $char = $char['characteristics'];

        foreach ($request->data as $row) {
            $brand = Brand::where('name->ru', $row['brand'])->first();

            $brand_id = !empty($brand) ? $brand->id : null;

            $product = Product::where('article_number', $row['article_number'])->first();

            if (!empty($product)) {
                $product->name = $row['name'];
                $product->price = $row['price'];
                $product->price_discount = $row['price_discount'];
                $product->popular = $row['popular'];
//                $product->currency = 'sum';
                $product->brand_id = $brand_id;
                $product->leader_of_sales = $row['leader_of_sales'];
                $product->slug = str_slug($row['name']['ru']);
                $product->save();
            } else {
                $product = new Product();
                $product->name = $row['name'];
                $product->price = $row['price'];
                $product->body = ['ru' => '', 'uz' => ''];
                $product->short_body = ['ru' => '', 'uz' => ''];
                $product->article_number = $row['article_number'];
                $product->price_discount = $row['price_discount'];
                $product->popular = $row['popular'];
//                $product->currency = 'sum';
                $product->brand_id = $brand_id;
                $product->leader_of_sales = $row['leader_of_sales'];
                $product->slug = str_slug($row['name']['ru']);
                $product->published = 0;
                $product->save();

                $product->categories()->attach([$row['category_id']]);

//                Product::create([
//                    'published' => 0,
//                    'child_id' => $product->id
//                ]);
            }

            $sync_data = [];

            if (!empty($char) && count($char) > 0) {
                $ids = $char->map(function ($char) {
                    return (int)$char['id'];
                });

                $product->characteristics()->detach($ids);

                for ($i = 0; $i < count($row['characteristics']); $i++) {
                    if ($char[$i]['type'] == 'checkbox') {
                        $value = $row['characteristics'][$i] == 1 || $row['characteristics'][$i] == true ? 'true' : 'false';
                    } else {
                        $value = $row['characteristics'][$i];
                    }

                    if ($value === null) {
                        $value = 'null';
                    }

                    $sync_data[$char[$i]['id']] = ['value' => $value];
                }

                $product->characteristics()->attach($sync_data);
            }
        }

        $this->success(trans('admin.messages.created'));

        return response()->json([
            'status' => true
        ]);
    }

    public function massAction(Request $request)
    {
        switch ($request->input('action')) {
            case "delete":
                foreach (Product::whereIn('id', $request->prod_id) as $product) {
                    $product->notifications()->delete();
                }
                $this->massAction->massDelete($request->prod_id);
                break;
            case "status-deactivate":
                $this->massAction->massUnpublish($request->prod_id);
                break;
        }

        $this->info(trans('admin.messages.success'));
        return redirect()->back();
    }

    public function export()
    {
        if (request('all') == true) $products = Product::all();
        else {
            $ids = json_decode(request('categories'));
            $products = collect([]);
            $categories = Category::whereIn('id', $ids)->get();
            foreach ($categories as $category) {
                $products = $products->merge($category->products);
                if (isset($category->children)) {
                    foreach ($category->children as $child) {
                        $products = $products->merge($child->products);
                        if (isset($child->children)) {
                            foreach ($child->children as $item) {
                                $products = $products->merge($item->products);
                            }
                        }
                    }
                }
            }
            $products = $products->unique('id');
        }
        return Excel::download(new ProductsExport($products), 'products.xlsx');
    }

}
