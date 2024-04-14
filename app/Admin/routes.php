<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\CompanyController;
use App\Admin\Controllers\ShopController;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\SubscriptionAgreementController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\SeoDataController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function ($router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('companies', CompanyController::class);
    $router->resource('shops', ShopController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('users', UserController::class);
    $router->resource('subscription_agreements', SubscriptionAgreementController::class);
    $router->resource('seo_data', SeoDataController::class);

    // 追加するルート
    Route::put('/subscription_agreements/{id}', 'SubscriptionAgreementController@update')->name('subscription_agreements.update');
});
