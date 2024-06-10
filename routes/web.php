<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Site')->middleware('locale')->group(function () {
    Route::get('/', 'MainPageController@index')->name('site.main.page');
    Route::get('/test', 'MainPageController@test');
    Route::get('locale/{lang}', 'LocaleController@setLocale')->name('site.setLocale');

    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('login', 'Controller@login');
        Route::post('verify', 'Controller@verify');
    });

    Route::group(['prefix' => 'profile', 'middleware' => 'authProfile'], function () {
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::post('/', 'ProfileController@update')->name('profile.update');

        Route::get('/orders', 'ProfileController@orders')->name('profile.orders');
        Route::get('/{order}', 'ProfileController@cancelOrder')->name('profile.orders.cancel');

        Route::match(['get', 'post'], '/address', 'ProfileController@address')->name('profile.address');
        Route::put('/address/{address}', 'ProfileController@addressUpdate');
    });

//    Route::group(['prefix' => 'brand'], function () {
//        Route::get('/{slug}', 'BrandController@index')->name('brand');
//    });

//    Route::prefix('pages')->group(function () {
//        Route::get('{slug}', 'PageController@getPage')->name('site.default-page');
//    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'CartController@index')->name('cart');
        Route::post('/', 'CartController@store')->name('cart.store');
        Route::put('/', 'CartController@update')->name('cart.update');


        Route::get('/preview', 'CartController@preview')->name('cart.preview');
        Route::get('/basket', 'CartController@basketCount')->name('cart.count');

        Route::delete('/all', 'CartController@removeAll')->name('cart.remove.all');
        Route::delete('/{product}', 'CartController@delete')->name('cart.delete');
//        Route::get('/oncredit/', 'CartController@oncredit');
    });

    Route::group(['prefix' => 'stocks'], function () {
        Route::match(['get', 'post'], '/', 'StockController@index')->name('stocks');
    });

    Route::group(['prefix' => 'checkout'], function () {
        Route::match(['get', 'post'], '/', 'CheckoutController@index')->name('checkout');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('{product}-{slug}', 'ProductController@show')->name('product.show');
        Route::post('{product}/comment/', 'CommentController@store')->name('comment.store')->middleware('authProfile');
//        Route::get('oncredit/{product}', 'ProductController@oncredit')->name('product.credit');

//        Route::post('notification/available', 'ProductController@notification_available');
//        Route::post('buy/click', 'ProductController@buy_click');
    });

    Route::group(['prefix' => 'coin-product'], function () {
        Route::get('{coinProduct}-{slug}', 'CoinProductController@show')->name('coin-product.show');
        Route::post('/order', 'CoinProductController@order')->name('coin-product.order');
    });

    Route::group(['prefix' => 'search'], function () {
        Route::match(['get', 'post'], '/', 'ProductController@search')->name('search');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@all')->name('categories');
        Route::get('/{category}/{slug}', 'CategoryController@index')->name('category.view');
        Route::get('/{category}/{slug}/{Category}/{slug_2}', 'CategoryController@show')->name('category.show');
        Route::get('/{category}/{slug}/{cat}/{slug_2}/{Category}/{slug_3}', 'CategoryController@showCatalog')->name('category.showParent');
        Route::post('/filter/{category}', 'CategoryController@filter')->name('category.filter');
    });

    Route::get('compilation/coin-products', 'CompilationController@coin_product')->name('compilation.coin-product');
    Route::get('compilation/{compilation}', 'CompilationController@view')->name('compilation.view');
    Route::post('compilation/{compilation}', 'CompilationController@paginate')->name('compilation.view');

//    Route::post('leave/feedback', 'FeedbackController@store')->name('leave.feedback');

    Route::group(['prefix' => 'favorites', 'middleware' => 'authProfile'], function () {
        Route::get('/', 'FavoriteController@index')->name('favorites');
        Route::post('/{product}', 'FavoriteController@store');
        Route::delete('/{product}', 'FavoriteController@delete');
    });

    Route::post('set-region', 'RegionController@setRegion')->name('set-region');

});

Route::any('/payment/{paysys}',function($paysys){
    return (new Goodoneuz\PayUz\PayUz)->driver($paysys)->handle();
});

Route::match(['post', 'get'], 'pay/check/{order}', 'Site\CheckoutController@check')->name('pay_check');

Route::any('/pay/{paysys}/{key}/{amount}',function($paysys, $key, $amount){
    $billing = App\Models\Billing::find($key);
    $model = Goodoneuz\PayUz\Services\PaymentService::convertKeyToModel($key);
    $url = route('pay_check', $billing->order_id); //request('redirect_url','/');
    $pay_uz = new Goodoneuz\PayUz\PayUz;
    $pay_uz
        ->driver($paysys)
        ->redirect($model, $amount, 860, $url);
})->name('payment.merchant');

Route::namespace('Dashboard')
    ->group(function () {
        Route::get('login', 'AuthController@showLoginForm')->name('login');
        Route::post('login', 'AuthController@login')->name('login');
        Route::get('logout', 'AuthController@logout')->name('logout');
    });


//Route::group(['prefix' => 'credit/apelsin/handle', 'namespace' => 'Apelsin'], function () {
//    Route::post('confirm', 'Controller@confirm');
//    Route::post('confirm/status', 'Controller@status');
//
////    Route::post('send/test', 'Controller@test');
//    Route::post('comment', 'Controller@comment');
//});

//Route::match(['get', 'post'], 'login', 'Auth\LoginController@login')->name('login');
//Route::get('logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');

//Auth::routes();
