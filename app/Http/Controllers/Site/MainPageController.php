<?php

namespace App\Http\Controllers\Site;

use App\Helpers\MainPage;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Compilation;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SpecialOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class MainPageController extends Controller
{
    protected $lang;
    protected $currency;
    protected $main;


    /**
     * MainPageController constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency->latest('id', 'desc')->limit(1)->first();
        $this->lang = app()->getLocale();
        $this->main = new MainPage();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lang = app()->getLocale();
        $brands = Brand::latest('id')->get();

        $newProducts = $this->main->getMainProducts('new');
        $popularProducts = $this->main->getMainProducts('popular');
        $liderProducts = $this->main->getMainProducts('lider');

        $popularCategories = $this->main->getPopularCategories();

        list($sliders, $middleSliders) = $this->main->getSliders($lang);

        $offers = SpecialOffer::all();
        $setting = Setting::find(1);
        $compilations = Compilation::query()->orderBy('position', 'asc')->published()->with('products')->get();
        $compilations = $compilations->filter(function ($compilation) {
            return $compilation->type != 'coin' || $compilation->coin_products->isNotEmpty();
        });

        $region_id = auth()->user()->region_id ?? $user->region_id ?? Cookie::get('region') ?? Setting::first()->region_id;

        foreach ($compilations as $compilation) {
            if ($compilation->type == 'default') {
                $compilation->loadMissing(['products' => function ($product) use ($region_id) {
                    return $product->published()->whereHas('regions', function ($query) use ($region_id) {
                        $query->where('id', $region_id);
                    })
                        ->with('screen:id,product_id,path,path_thumb', 'unit')
                        ->withCount('comments')
                        ->get(['id', 'name', 'price', 'price_discount', 'slug', 'available']);
                }]);
                $compilation->products->map(function ($product) {
                    $product->type = 'default';
                    [$product->price, $product->price_discount] = $product->getRegionPrice();
                    $product->count = $product->getCount();
                });
            } else {
                $compilation->loadMissing(['coin_products' => function ($product) {
                    return $product->with('screen:id,product_id,path,path_thumb', 'unit')->get();
                }]);
                $compilation->coin_products->map(function ($product) {
                    $product->type = 'coin';
                });
            }
        }

        //return abs(self::pmt(0.23/12,11,1000000));

        return view('site.index', compact(
            'brands',
            'liderProducts',
            'popularProducts',
            'newProducts',
            'popularCategories',
            //'toppedPost',
            'sliders',
            'offers',
            'middleSliders',
            'setting',
            'compilations')
        );
    }
}
