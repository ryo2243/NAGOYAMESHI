<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest', 'guest:admin']);

Auth::routes(['verify' => true]);

Route::middleware('verified')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('company', [CompanyController::class, 'index'])->name('company.index');
Route::get('terms', [TermController::class, 'index'])->name('terms.index');
Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);

Route::resource('restaurants.reviews', ReviewController::class)->except('show');

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
