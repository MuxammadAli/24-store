<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/dashboard', 'namespace' => 'Dashboard', 'middleware' => ['auth:staff', 'blocked']], function () {
    Route::get('/', 'Controller@index')->name('dashboard');
    Route::post('/count', 'Controller@count')->name('dashboard.count');

    Route::group(['prefix' => 'users', 'namespace' => 'User'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.users');
        Route::get('/import', 'Controller@import');
        Route::get('/export', 'Controller@export')->name('dashboard.users.export');
        Route::get('add/hours', 'Controller@addHours')->name('dashboard.users.add.hours');
        Route::get('{user}', 'Controller@view')->name('dashboard.users.view');
        //Route::match(['get', 'post'], 'update/{user}', 'Controller@edit')->name('dashboard.users.update');
    });

    Route::group(['prefix' => 'logs', 'namespace' => 'Log'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.logs');
    });

    Route::namespace('User')->prefix('staffs')->group(function (){
        Route::get('/', 'Controller@getStaffs')->name('dashboard.staffs');
        Route::match(['get', 'post'], 'store', 'Controller@store')->name('dashboard.staffs.store');
        Route::match(['get', 'post'], 'update/{staff}', 'Controller@update')->name('dashboard.staffs.update');
        Route::match(['get'], 'block/{staff}', 'Controller@block')->name('dashboard.staffs.block');
    });

    Route::namespace('Notification')->prefix('notifications')->group(function (){
        Route::get('/', 'Controller@index')->name('dashboard.notifications');
        Route::post('/store', 'Controller@store')->name('dashboard.notifications.store');
    });

    Route::group(['prefix' => 'orders', 'namespace' => 'Orders'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.orders');
        Route::get('/invoice/{order}', 'Controller@invoice_print')->name('dashboard.invoice_print');
        Route::get('/view/{order}', 'Controller@view')->name('dashboard.orders.view');
        Route::get('/search', 'Controller@search')->name('dashboard.orders.search');
//        Route::match(['get', 'post'], '/update/{order}', 'Controller@update')->name('dashboard.orders.edit');

        Route::get('/filter', 'Controller@filter')->name('dashboard.orders.filter');
        Route::get('/archive', 'Controller@archive')->name('dashboard.orders.archive');
        Route::post('/archive', 'Controller@mass_archived')->name('dashboard.orders.mass_archived');

        Route::get('/export', 'Controller@export')->name('dashboard.orders.export');

        Route::get('/products/{product}', 'Controller@product');
        Route::post('/product/search', 'Controller@search_update');
        Route::post('/product/info/{product}', 'Controller@product_info');
        Route::get('/status/{order}/{status}', 'Controller@change_status')->name('dashboard.orders.status');
        Route::post('/status', 'Controller@comments')->name('dashboard.orders.comments_status');
    });

    Route::group(['prefix' => 'carts', 'namespace' => 'Cart'], function () {
        Route::get('', 'Controller@index')->name('dashboard.cart.index');
        Route::get('{key}', 'Controller@show')->name('dashboard.cart.show');
        Route::get('clear/{key}', 'Controller@clear')->name('dashboard.cart.clear');
        Route::get('delete/{cart}', 'Controller@delete')->name('dashboard.cart.delete');
        Route::post('{cart}/add/{count}', 'Controller@addCount')->name('dashboard.cart.add-count');
        Route::post('{cart}/minus/{count}', 'Controller@minusCount')->name('dashboard.cart.minus-count');
    });

    Route::group(['prefix' => 'brands', 'namespace' => 'Brand'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.brands');
        Route::match(['get', 'post'], '/update/{brand}', 'Controller@update')->name('dashboard.brand.update');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.brand.store');
        Route::get('/delete/{brand}', 'Controller@delete')->name('dashboard.brand.delete');
    });

    Route::group(['prefix' => 'partners', 'namespace' => 'Partner'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.partners');
        Route::match(['get', 'post'], '/update/{partner}', 'Controller@update')->name('dashboard.partner.update');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.partner.store');
        Route::get('/delete/{partner}', 'Controller@delete')->name('dashboard.partner.delete');
    });

    Route::group(['prefix' => 'sliders', 'namespace' => 'Slider'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.sliders');
        Route::match(['get', 'post'], '/update/{slider}', 'Controller@update')->name('dashboard.slider.update');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.slider.store');
        Route::get('/delete/{slider}', 'Controller@delete')->name('dashboard.slider.delete');

    });

    Route::group(['prefix' => 'currency', 'namespace' => 'Currency'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.currency');
        Route::match(['get', 'post'],'/store', 'Controller@store')->name('dashboard.currency.store');
    });

    Route::group(['prefix' => 'branches', 'namespace' => 'Branch'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.branches');
        Route::get('/preview/{branch}', 'Controller@show')->name('dashboard.branches.show');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.branches.store');
        Route::match(['get', 'post'], '/update/{branch}', 'Controller@update')->name('dashboard.branches.update');
        Route::get('delete/{branch}', 'Controller@destroy')->name('dashboard.branches.delete');
    });

    Route::group(['prefix' => 'specialOffers', 'namespace' => 'SpecialOffer'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.specialOffers');
        Route::get('/preview/{specialOffer}', 'Controller@show')->name('dashboard.specialOffers.show');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.specialOffers.store');
        Route::match(['get', 'post'], '/update/{specialOffer}', 'Controller@update')->name('dashboard.specialOffers.update');
        Route::get('delete/{specialOffer}', 'Controller@delete')->name('dashboard.specialOffers.delete');
    });

    Route::group(['prefix' => 'settings', 'namespace' => 'Setting'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.settings');
        Route::post('/update/{setting}', 'Controller@update')->name('dashboard.settings.update');
        Route::match(['get', 'post'], '/delivery', 'Controller@delivery')->name('dashboard.settings.delivery');
    });
    Route::match(['get', 'put'], 'settings/reasons', 'Reason\Controller@index')->name('dashboard.settings.reason');

    Route::group(['prefix' => 'compilations', 'namespace' => 'Compilation'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.compilations');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.compilations.store');
        Route::match(['get', 'post'], '/update/{compilation}', 'Controller@update')->name('dashboard.compilations.update');
        Route::post('/product/search', 'Controller@search');
        Route::get('/delete/{compilation}', 'Controller@delete')->name('dashboard.compilations.delete');
    });

    Route::group(['prefix' => 'files', 'namespace' => 'File'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.files');
        Route::post('/store', 'Controller@store')->name('dashboard.file.store');
        Route::get('/delete/{file}', 'Controller@delete')->name('dashboard.file.delete');
    });

    Route::group(['prefix' => 'units', 'namespace' => 'Unit'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.units');
        Route::match(['get', 'post'],'/store', 'Controller@store')->name('dashboard.units.store');
        Route::match(['get', 'post'],'/edit/{unit}', 'Controller@edit')->name('dashboard.units.edit');
        Route::get('/delete/{unit}', 'Controller@delete')->name('dashboard.units.delete');
    });

    Route::group(['prefix' => 'products', 'namespace' => 'Product'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.products');
//        Route::match(['get', 'post'], '/import', 'Controller@import')->name('dashboard.products.import');
        Route::post('/preview/store', 'Controller@previewStore')->name('dashboard.products.preview.store');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.product.store');
        Route::match(['get', 'post'], '/update/{product}', 'Controller@update')->name('dashboard.product.update');
        Route::get('/delete/{product}', 'Controller@delete')->name('dashboard.product.delete');
        Route::post('/delete/screen/{screen}', 'Controller@delete_screen')->name('dashboard.product.screen.delete');
        Route::get('/search', 'Controller@search')->name('dashboard.product.search');
        Route::get('/characteristics/{id}', 'Controller@characteristics')->name('dashboard.product.characteristics');
        Route::post('/mass/action', 'Controller@massAction')->name('dashboard.products.mass.action');
        Route::get('export', 'Controller@export')->name('dashboard.products.export');
    });

    Route::group(['prefix' => 'coin-product', 'namespace' => 'CoinProduct'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.coin-product.index');
        Route::match(['get', 'post'], 'store', 'Controller@store')->name('dashboard.coin-product.store');
        Route::match(['get', 'put'], 'update/{coinProduct}', 'Controller@update')->name('dashboard.coin-product.update');
        Route::get('/delete/{coinProduct}', 'Controller@delete')->name('dashboard.coin-product.delete');
        Route::get( '/search', 'Controller@search')->name('dashboard.coin-product.search');
        Route::post('/mass/action', 'Controller@massAction')->name('dashboard.coin-product.mass.action');
    });

    Route::group(['prefix' => 'coin-product-order', 'namespace' => 'CoinProductOrder'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.coin-product-order.index');
        Route::get('/status/{coinProductOrder}/{status}', 'Controller@status')->name('dashboard.coin-product-order.status');
    });

    Route::group(['prefix' => 'categories', 'namespace' => 'Category'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.categories');
        Route::get('/json', 'Controller@json');
        Route::match(['get','post'], '/store', 'Controller@store')->name('dashboard.categories.store');
        Route::match(['get','post'], '/update/{category}', 'Controller@update')->name('dashboard.categories.update');
        Route::get('/delete/{category}', 'Controller@delete')->name('dashboard.categories.delete');
        Route::post('/position', 'Controller@position_save');
        Route::get('/test', 'Controller@test');
    });

    Route::group(['prefix' => 'colors', 'namespace' => 'Color'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.colors');
        Route::match(['get','post'], '/store', 'Controller@store')->name('dashboard.colors.store');
        Route::match(['get','post'], '/update/{color}', 'Controller@update')->name('dashboard.colors.update');
        Route::get('/delete/{color}', 'Controller@delete')->name('dashboard.colors.delete');
    });

    Route::group(['prefix' => 'pages', 'namespace' => 'Page'], function () {
        Route::match(['get','post'], '/store', 'Controller@store')->name('dashboard.pages.store');
        Route::match(['get','post'], '/update/{page}', 'Controller@update')->name('dashboard.pages.update');
        Route::get('/delete/{page}', 'Controller@destroy')->name('dashboard.pages.destroy');

        Route::post('upload/image', 'Controller@image_upload')->name('dashboard.pages.image_upload');
    });

    Route::group(['prefix' => 'feedback', 'namespace' => 'Feedback'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.feedback.index');
        Route::get('{feedback}', 'Controller@show')->name('dashboard.feedback.show');
        Route::get('delete/{feedback}', 'Controller@destroy')->name('dashboard.feedback.delete');
    });

    Route::group(['prefix' => 'comments', 'namespace' => 'Comment'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.comments');
        Route::get('/view/{comment}', 'Controller@update')->name('dashboard.comment.update');
        Route::get('/publish/{comment}', 'Controller@publish')->name('dashboard.comment.publish');
        Route::get('/delete/{comment}', 'Controller@delete')->name('dashboard.comment.delete');
    });

    Route::group(['prefix' => 'billings', 'namespace' => 'Billing'], function () {
        Route::get('/', 'Controller@index')->name('billing');
        Route::get('/search', 'Controller@search')->name('billing.search');
        Route::get('/status/{billing}/{status}', 'Controller@status')->name('billing.status');
    });

    Route::group(['prefix' => 'regions', 'namespace' => 'Region'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.regions');
        Route::match(['get','post'], '/store', 'Controller@store')->name('dashboard.region.store');
        Route::match(['get','post'], '/update/{region}', 'Controller@update')->name('dashboard.region.update');
        Route::get('/delete/{region}', 'Controller@delete')->name('dashboard.region.delete');
    });

    Route::group(['prefix' => 'notification', 'namespace' => 'Notification'], function () {
        Route::get('/', 'Controller@notification_available')->name('dashboard.notification_available');
        Route::get('/view/{product}', 'Controller@notification_available_view')->name('dashboard.notification_available.view');
    });

    Route::group(['prefix' => 'product-notifications', 'namespace' => 'ProductNotification'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.product-notification.index');
    });

    Route::group(['prefix' => 'cities', 'namespace' => 'City'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.cities');
        Route::match(['get','post'], '/store', 'Controller@store')->name('dashboard.city.store');
        Route::match(['get','post'], '/update/{city}', 'Controller@update')->name('dashboard.city.update');
        Route::get('/delete/{city}', 'Controller@delete')->name('dashboard.city.delete');
    });

    Route::group(['prefix' => 'roles', 'namespace' => 'Role'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.roles');
        Route::match(['get','post'], '/store', 'Controller@store')->name('dashboard.role.store');
        Route::match(['get','post'], '/update/{role}', 'Controller@update')->name('dashboard.role.update');
        Route::get('/delete/{role}', 'Controller@delete')->name('dashboard.role.delete');
    });

    Route::group(['prefix' => 'suppliers', 'namespace' => 'Supplier'], function () {
        Route::get('/', 'Controller@index')->name('dashboard.supplier.index');
        Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.supplier.store');
        Route::match(['get', 'put'], '/update/{supplier}', 'Controller@update')->name('dashboard.supplier.update');
        Route::get('block/{supplier}', 'Controller@block')->name('dashboard.supplier.block');
    });
    Route::get('agents', 'Agent\Controller@index')->name('dashboard.agent.index');
});
