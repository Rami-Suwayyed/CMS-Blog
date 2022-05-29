<?php

use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Frontend\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',                                 [HomeController::class,'index'])->name('frontend.index');
// Authentication Routes...
Route::get('/login',                            [App\Http\Controllers\Frontend\LoginController::class,'showLoginForm'])->name('frontend.show_login_form');
Route::post('login',                            [App\Http\Controllers\Frontend\LoginController::class,'login'])->name('frontend.login');
Route::post('logout',                           [App\Http\Controllers\Frontend\LoginController::class,'logout'])->name('frontend.logout');
Route::get('register',                          [App\Http\Controllers\Frontend\RegisterController::class,'showRegistrationForm'])->name('frontend.show_register_form');
Route::post('register',                         [App\Http\Controllers\Frontend\RegisterController::class,'register'])->name('frontend.register');
Route::get('password/reset',                    [App\Http\Controllers\Frontend\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email',                   [App\Http\Controllers\Frontend\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',            [App\Http\Controllers\Frontend\ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',                   [App\Http\Controllers\Frontend\ResetPasswordController::class,'reset'])->name('password.update');
Route::get('email/verify',                      [App\Http\Controllers\Frontend\VerificationController::class,'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',         [App\Http\Controllers\Frontend\VerificationController::class,'verify'])->name('verification.verify');
Route::post('email/resend',                     [App\Http\Controllers\Frontend\VerificationController::class,'resend'])->name('verification.resend');



Route::group(['prefix' => 'admin'], function() {
    // Authentication Routes...
    Route::get('/login',                            [App\Http\Controllers\Backend\LoginController::class,'showLoginForm'])->name('admin.show_login_form');
    Route::post('login',                            [App\Http\Controllers\Backend\LoginController::class,'login'])->name('admin.login');
    Route::post('logout',                           [App\Http\Controllers\Backend\LoginController::class,'logout'])->name('admin.logout');
    Route::get('password/reset',                    [App\Http\Controllers\Backend\ForgotPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email',                   [App\Http\Controllers\Backend\ForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}',            [App\Http\Controllers\Backend\ResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset',                   [App\Http\Controllers\Backend\ResetPasswordController::class,'reset'])->name('admin.password.update');
});
