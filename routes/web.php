<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('ccaptcha')->group(function () {
    Route::get('refresh', function () {
        return response()->json(['captcha'=> captcha_img('flat')]);
    });
});

Route::prefix('user')->name("profile.")->middleware(["auth"])->group(function () {
    Route::get('profile', [ProfileController::class,'show'])->name("show");
    Route::post('profile', [ProfileController::class,'update'])->name("update");
});
