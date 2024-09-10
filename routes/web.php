<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMailController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminWishListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\WishListController;
use App\Models\User;
use App\Notifications\ReactiveUserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



// Example Routes

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('wishlists', [HomeController::class, 'wishlists'])->name('wishlists');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

Route::post('user-register/add-wishlist', [UserRegisterController::class, 'addWishlist'])->name('user-register.add-wishlist');
Route::resource('user-register', UserRegisterController::class)->only(['create', 'store']);

Route::middleware(['auth'])->group(function () {


    Route::prefix('user')->name('user.')->group(function () {

        Route::resource('profile', UserProfileController::class)->only(['index', 'edit', 'update']);

        Route::get('wishlist/get', [WishListController::class, 'getWishList'])->name('wishlist.get');
        Route::resource('wishlist', WishListController::class);
    });

    Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {

        Route::get('',[AdminDashboardController::class,'index'])->name('dashboard.index');

        Route::resource('wishlists', AdminWishListController::class);

        Route::get('users/{user}/wishlists', [AdminUserController::class, 'wishLists'])->name('users.wishlists');
        Route::put('users/{user}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
        Route::put('users/{user}/verifyLowIncome', [AdminUserController::class, 'verifyLowIncome'])->name('users.verifyLowIncome');
        Route::resource('users', AdminUserController::class);

        Route::resource("profile", AdminProfileController::class)->only(["index", "update"]);

        Route::resource('emails',AdminMailController::class);


    });

});


Route::get('test', function () {

    $user=User::find(2);
    $user->notify(new ReactiveUserNotification($user));
});

