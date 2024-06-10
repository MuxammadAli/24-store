<?php

use App\Http\Controllers\Api\Agent\AgentController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Comment\CommentController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Recovery\RecoveryController;
use App\Http\Controllers\Api\Region\RegionController;
use App\Http\Controllers\Api\Statistics\StatisticsController;
use App\Http\Controllers\Api\Unit\UnitController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Route::get('products/all', function () {
//    return response()->json(\Spatie\Activitylog\Models\Activity::all());
//});

Route::middleware('apiAuth')->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('create', [ProductController::class, 'create']);
        Route::post('store', [ProductController::class, 'store']);
        Route::post('update/{product}', [ProductController::class, 'update']);
        Route::delete('delete/{product}', [ProductController::class, 'delete']);
        Route::prefix('region')->group(function () {
            Route::post('store', [ProductController::class, 'storeRegion']);
            Route::put('update', [ProductController::class, 'updateRegion']);
        });
    });

    Route::prefix('cart')->group(function () {
        Route::post('', [CartController::class, 'index']);
    });

    Route::prefix('category')->group(function () {
        Route::get('', [CategoryController::class, 'index']);
        Route::get('list', [CategoryController::class, 'list']);
        Route::get('sub-categories', [CategoryController::class, 'subCategories']);
        Route::get('/show/{id}', [CategoryController::class, 'show']);
        Route::get('parents', [CategoryController::class, 'parents']);
    });

    Route::prefix('unit')->group(function () {
        Route::get('', [UnitController::class, 'index']);
        Route::get('{unit}', [UnitController::class, 'show']);
    });

    Route::prefix('order')->group(function () {
        Route::post('', [OrderController::class, 'index']);
        Route::get('statistics', [OrderController::class, 'statistics']);
        Route::post('status', [OrderController::class, 'status']);
        Route::get('agents', [OrderController::class, 'agents']);
        Route::get('{order}', [OrderController::class, 'view']);
        Route::get('address/{order}', [OrderController::class, 'address']);
        Route::get('logs/{order}', [OrderController::class, 'log']);
        Route::post('logs', [OrderController::class, 'logs']);
        Route::put('edit/{order}', [OrderController::class, 'edit']);
    });

    Route::prefix('region')->group(function () {
        Route::get('', [RegionController::class, 'all']);
        Route::post('/index', [RegionController::class, 'index']);
        Route::get('{region}', [RegionController::class, 'view']);
    });

    Route::prefix('user')->group(function () {
        Route::post('', [UserController::class, 'index']);
        Route::get('{user}', [UserController::class, 'view']);
        Route::post('{user}', [UserController::class, 'upload']);
        Route::get('{supplier}/all', [UserController::class, 'shops']);
        Route::get('{supplier}/{user}/view', [UserController::class, 'shop_view']);
    });

    Route::prefix('comments')->group(function () {
        Route::get('{product}', [CommentController::class, 'index']);
        Route::get('view/{comment}', [CommentController::class, 'view']);
        Route::put('update/{comment}', [CommentController::class, 'update']);
    });

    Route::get('products', [ProductController::class, 'index'])->name('product.index');
    Route::prefix('agent/{supplier_id}')->group(function () {
        Route::get('', [AgentController::class, 'index']);
        Route::get('{agent}', [AgentController::class, 'view']);
        Route::post('', [AgentController::class, 'store']);
        Route::post('{agent}', [AgentController::class, 'update']);
        Route::match(['get', 'post'], '{agent}/plans', [AgentController::class, 'plans']);
        Route::post('{agent}/upload', [AgentController::class, 'upload']);
        Route::get('{agent}/products', [AgentController::class, 'products']);
        Route::delete('{agent}', [AgentController::class, 'block']);
    });

    Route::prefix('recovery')->group(function () {
        Route::get('{supplier}', [RecoveryController::class, 'index']);
        Route::get('{supplier}/count', [RecoveryController::class, 'count']);
        Route::get('view/{recovery}', [RecoveryController::class, 'view']);
        Route::put('status', [RecoveryController::class, 'status']);
    });

    Route::prefix('statistics')->group(function () {
        Route::get('user/{supplier}', [StatisticsController::class, 'user']);
        Route::get('recovery/{supplier}', [StatisticsController::class, 'recovery']);
        Route::get('plan/{supplier}', [StatisticsController::class, 'plan']);
        Route::get('categories/{supplier}', [StatisticsController::class, 'categories']);
    });

    Route::prefix('payment')->group(function () {
        Route::get('{agent}', [PaymentController::class, 'index']);
        Route::post('', [PaymentController::class, 'create']);
    });
});
