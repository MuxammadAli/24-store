<?php


namespace App\Helpers;

use App\User;
use App\Models\Order;
use App\Models\Currency;
use App\Models\OrderProducts;
use App\Models\Product as Model;
use App\Models\NotificationAvailable;


class Product
{

    protected $currency;

    public function __construct()
    {
        $this->currency = Currency::latest('id', 'desc')->limit(1)->first();
    }

    /**
     * @param $product
     * @return mixed
     */
    public function getPopularProducts($product)
    {
        $popularProducts = Model::inRandomOrder()
            ->published()
            ->whereNotIn('id', [$product->id])
            ->isAvailable()
            ->with('comments', 'screen', 'unit')
            ->limit(10)
            ->get();

        $popularProducts->map(function ($product) {
            $product->categories->map(function ($category) {
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
        });

        $popularProducts->makeHidden(['created_at', 'updated_at', 'sizes', 'color_id']);

        return $popularProducts;
    }

    /**
     * @param Model $product
     * @return array
     */
    public function getProductShowAttributes(Model $product)
    {
        $product->update([
            'views' => $product->views + 1
        ]);

        $product->loadMissing(['comments', 'categories:id,name', 'screens', 'characteristics', 'unit']);
        $product->loadCount(['comments']);

        $product->makeHidden(['created_at', 'updated_at', 'sizes', 'color_id']);

        $category = $product->categories()->first();

        return [$product, $category];
    }

    /**
     * @param $name
     * @param null $order_by
     * @return mixed
     */
    public function getSearchProduct($name, $order_by = null)
    {
        $products = Model::select('id', 'name', 'price', 'price_discount', 'slug', 'popular', 'article_number', 'leader_of_sales', 'available', 'count', 'unit_id', 'images', 'productable_type')
            ->where('name->ru', 'ilike', '%'.$name.'%')
            ->orWhere('name->uz', 'ilike', '%'.$name.'%')
            ->withCount('comments')
            ->with('screen', 'unit')
            ->published();

        if ($order_by) {
            switch ($order_by) {
                case 'new':
                    $products = $products->latest();
                    break;
                case 'cheap':
                    $products = $products->orderByRaw('COALESCE(price_discount, price) ASC');
                    break;
                case 'expensive':
                    $products = $products->orderByRaw('COALESCE(price_discount, price) DESC');
                    break;
            }
        }

        $products = $products->paginate(15);

        $products->map(function (Model $product) {
            [$product->price, $product->price_discount] = $product->getRegionPrice();
        });

        return $products;
    }

    /**
     * @param $request
     */
    public function createNotificationProduct($request)
    {
        $phone = str_replace(['-', ' ', '(', ')', '+'], '', $request->phone);

        NotificationAvailable::firstOrCreate([
            'product_id' => $request->product_id,
            'phone' => $phone
        ]);
    }

    /**
     * @param Model $product
     * @param $request
     * @return mixed
     */
    public function StoreBuyOneClick(Model $product, $request)
    {
        $currency = Currency::latest('id', 'desc')->first();
        $price = $product->price_discount ? $product->getPriceDiscount() : $product->getPrice();
        $phone = str_replace(['+', '(', ')', ' ', '-'], '', $request->phone);

        if (auth()->check() && auth()->user()->phone == $phone) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = $this->createUser($phone, $request);
        }

        $order = Order::create([
            'payment_type' => 'cash',
            'user_id' => $user_id,
            'type_delivery' => 'pickup',
            'type' => 'one_click',
            'currency' => $currency,
            'payment_status' => 'cash',
            'price_delivery' => 0,
            'price_product' => $price,
            'comment' => $request->comment
        ]);

        $discount = $product->price_discount ? 100 - $product->price_discount * 100 / $product->price : null;

        OrderProducts::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'discount' => round($discount),
            'count' => 1,
            'size' => null,
            'color_id' => $product->children->id,
            'price' => $price
        ]);

        return $order;
    }

    public function storeOnCredit($product)
    {
        $price = $product->price_discount ? $product->getPriceDiscount() : $product->getPrice();

        $order = Order::create([
            'payment_type' => 'credit',
            'user_id' => auth()->user()->id,
            'type_delivery' => 'pickup',
            'currency' => $this->currency,
            'payment_status' => 'waiting',
            'price_delivery' => 0,
            'price_product' => $price,
        ]);

        $discount = $product->price_discount ? 100 - $product->price_discount * 100 / $product->price : null;

        OrderProducts::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'discount' => round($discount),
            'count' => 1,
            'size' => null,
            'color_id' => $product->children->id,
            'price' => round($price, 0)
        ]);

        return $order;
    }

    /**
     * @param $phone
     * @param $request
     * @return mixed
     */
    private function createUser($phone, $request)
    {
        $user = User::findByPhone($phone)->first();

        if (!empty($user)) {
            $user_id = $user->id;
        } else {
            $user = User::create([
                'first_name' => $request->first_name,
                'phone' => $phone,
                'email' => $request->email
            ]);

            $user_id = $user->id;
        }

        return $user_id;
    }
}
