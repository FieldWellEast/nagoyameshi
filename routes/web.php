<?php

use Encore\Admin\Facades\Admin;
use App\Admin\Controllers\CompanyController as AdminCompanyController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopListController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewPostController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubscriptionController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\SuccessPageController;
use App\Http\Controllers\ShopSearchController;
use App\Http\Controllers\SubscriptionAgreementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
// ログイン後のリダイレクト先をindex.blade.phpに変更するためのルート
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// index.blade.phpを表示するためのルートを追加
Route::get('/index', function () {
    return view('index');
});





//トップページ
Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/auth/login', [LoginController::class, 'login']);

//検索結果
Route::get('/shop/search', [ShopSearchController::class, 'search'])->name('shop.search');

//会社情報
Route::get('/company', [CompanyController::class, 'index'])->name('company');

//店舗一覧
Route::get('/shop/list', [ShopController::class, 'list'])->name('shop.list');
Route::get('shops/{id}', [ShopController::class, 'show'])->name('shops.show');

//店舗詳細
Route::get('/shop/details/{id}', [ShopController::class, 'details'])->name('shop.details');//Todo:Route [shop.details] not defined.views / favorite/ list.blade.php
Route::get('/reservation/details/{id}', [ReservationController::class, 'details'])->name('reservation.details');
Route::post('/shop/details/{id}', [ShopController::class, 'details'])->name('shop.details.post');
Route::post('/shop/details/{id}', [ReviewPostController::class, 'details'])->name('shop.review');

//予約
Route::get('/reservation/register', [ReservationController::class, 'register'])->name('reservation.register');
Route::get('/reservation/list', [ReservationController::class, 'list'])->name('reservation.list');
Route::get('/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('reservation.edit');
Route::put('/reservation/{id}', [ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');


//お気に入り
Route::get('/favorite/list', [FavoriteController::class, 'list'])->name('favorite.list');
Route::get('/favorite/{id}/edit', [FavoriteController::class, 'edit'])->name('favorite.edit');
Route::post('/favorite/toggle/{shopId}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

//レビュー投稿
Route::get('/shop/details/{id}', [ReviewPostController::class, 'details'])->name('shop.review');
// Route::get('/shops/{id}/reviews', [ReviewController::class, 'details'])->name('shops.reviews.details');
// Route::get('/reviewpost/{shopId}', [ReviewController::class, 'create'])->name('review.create');
// Route::get('/shops/{id}/reviews', [ReviewController::class, 'details'])->name('shops.reviews.details');
// Route::get('/reviewpost/{shopId}', [ReviewController::class, 'create'])->name('review.create');


//マイページ
Route::get('mypage', [MyPageController::class, 'mypage'])->name('mypage');


// 会員情報
Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/register-membership', [UserController::class, 'registerMembership'])->name('user.registerMembership');
Route::post('/user/cancel-membership', [UserController::class, 'cancelMembership'])->name('user.cancelMembership');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');


// 有料会員
Route::get('/subscription/register', [UserSubscriptionController::class, 'register'])->name('subscription.register');
Route::post('/user/subscription/register_card', [UserSubscriptionController::class, 'registerCard'])->name('user.subscription.register_card');
Route::post('/user/token', [UserSubscriptionController::class, 'token'])->name('user.token');
Route::put('/cancel-subscription', [UserSubscriptionController::class, 'cancelSubscription'])->name('cancel_subscription');
Route::get('/user/subscription_agreement', [UserSubscriptionController::class, 'agreement'])->name('user.subscription_agreement');
Route::get('/card/show', [UserSubscriptionController::class, 'showCard'])->name('card.show');
Route::post('/user/update-card', [UserSubscriptionController::class, 'updateCard'])->name('user.updateCard');
Route::post('/register_card', [UserSubscriptionController::class, 'registerCard'])->name('register_card');
Route::post('/card/update', [UserSubscriptionController::class, 'updateCard'])->name('update_card');
Route::get('/card/edit', [UserSubscriptionController::class, 'credit_edit'])->name('card.edit');
Route::get('/subscription/details', [UserSubscriptionController::class, 'details'])->name('subscription.details');
Route::get('/register_card', [UserSubscriptionController::class, 'registerCard'])->name('register_card');



//メールテンプレート
// Route::resource('email-templates', EmailTemplateController::class);
