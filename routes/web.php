<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Laravel\Cashier\Cashier;

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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('company', [CompanyController::class, 'index'])->name('company.index');
Route::get('terms', [TermController::class, 'index'])->name('terms.index');
Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);

Route::middleware('verified')->group(function () {
    Route::resource('restaurants.reviews', ReviewController::class)->except('show');
    Route::resource('restaurants.reservations', ReservationController::class)->only(['create', 'store'])->middleware('subscribed');
    Route::resource('reservations', ReservationController::class)->only(['index', 'destroy']);

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('user', [UserController::class, 'update'])->name('user.update');

    // サブスク用のルーティング
    Route::get('subscription', function () {
        return view('subscription.create', [
            'intent' => Auth::user()->createSetupIntent()
        ]);
    })->name('subscription.create');

    Route::post('subscription', function (Request $request) {
        $request->user()->newSubscription(
            'premium_plan',
            'price_1LcdzfH3mwyalYUk97XO4NdS'
        )->create($request->paymentMethodId);

        return redirect()->route('home')->with('flash_message', '有料プランへの登録が完了しました。');
    })->name('subscription.store');

    Route::get('subscription/payment', function () {
        return view('subscription.payment', [
            'user' => Auth::user(),
            'intent' => Auth::user()->createSetupIntent()
        ]);
    })->name('subscription.payment');

    Route::post('subscription/payment', function (Request $request) {
        $request->user()->updateDefaultPaymentMethod($request->paymentMethodId);

        return redirect()->route('home')->with('flash_message', 'お支払い方法を変更しました。');
    })->name('subscription.updatePayment');

    Route::get('subscription/cancel', function () {
        return view('subscription.cancel');
    })->name('subscription.cancel');

    Route::post('subscription/cancel', function () {
        Auth::user()->subscription('premium_plan')->cancelNow();
        return redirect()->route('home')->with('flash_message', '有料プランを解約しました。');
    })->name('subscription.cancel');
});

// 管理者用のルーティング（ミドルウェアによる認証がコントローラ内で行われているものをグループ化）
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [Admin\Auth\LoginController::class, 'login'])->name('login');

    Route::get('/', [Admin\HomeController::class, 'index'])->name('home');
});

// 管理者用のルーティング（ミドルウェアによる認証がコントローラ内で行われていないものをグループ化）
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin.auth'], function () {
    Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [Admin\UserController::class, 'show'])->name('users.show');

    Route::resource('restaurants', Admin\RestaurantController::class);

    Route::resource('categories', Admin\CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('company', Admin\CompanyController::class)->only(['index', 'edit', 'update']);

    Route::resource('terms', Admin\TermController::class)->only(['index', 'edit', 'update']);
});
