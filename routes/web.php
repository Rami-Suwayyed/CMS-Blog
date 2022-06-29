<?php

use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UsersController;
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
Route::get('/',                                 [App\Http\Controllers\Frontend\IndexController::class,'index'])->name('frontend.index');
// Authentication Routes...
Route::get('/login',                            [App\Http\Controllers\Frontend\Auth\LoginController::class,'showLoginForm'])->name('frontend.show_login_form');
Route::post('login',                            [App\Http\Controllers\Frontend\Auth\LoginController::class,'login'])->name('frontend.login');
Route::post('logout',                           [App\Http\Controllers\Frontend\Auth\LoginController::class,'logout'])->name('frontend.logout');
Route::get('register',                          [App\Http\Controllers\Frontend\Auth\RegisterController::class,'showRegistrationForm'])->name('frontend.show_register_form');
Route::post('register',                         [App\Http\Controllers\Frontend\Auth\RegisterController::class,'register'])->name('frontend.register');
Route::get('password/reset',                    [App\Http\Controllers\Frontend\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email',                   [App\Http\Controllers\Frontend\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',            [App\Http\Controllers\Frontend\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',                   [App\Http\Controllers\Frontend\Auth\ResetPasswordController::class,'reset'])->name('password.update');
Route::get('email/verify',                      [App\Http\Controllers\Frontend\Auth\VerificationController::class,'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',         [App\Http\Controllers\Frontend\Auth\VerificationController::class,'verify'])->name('verification.verify');
Route::post('email/resend',                     [App\Http\Controllers\Frontend\Auth\VerificationController::class,'resend'])->name('verification.resend');


Route::group(['middleware' => 'verified'], function () {
    Route::get('/dashboard',                    [UsersController::class,'index'])->name('frontend.dashboard');


    Route::name("users.")->group(function () {

    Route::get('/edit-info',                    [UsersController::class,'edit_info'])->name('edit_info');
    Route::post('/edit-info',                   [UsersController::class,'update_info'])->name('update_info');
    Route::post('/edit-password',               [UsersController::class,'update_password'])->name('update_password');


    Route::get('/create-post',                  [UsersController::class,'create_post'])->name('post.create');
    Route::post('/create-post',                 [UsersController::class,'store_post'])->name('post.store');

    Route::get('/edit-post/{post_id}',          [UsersController::class,'edit_post'])->name('post.edit');
    Route::put('/edit-post/{post_id}',          [UsersController::class,'update_post'])->name('post.update');

    Route::delete('/delete-post/{post_id}',     [UsersController::class,'destroy_post'])->name('post.destroy');
    Route::post('/delete-post-media/{media_id}',[UsersController::class,'destroy_post_media'])->name('post.media.destroy');

    Route::get('/comments',                     [UsersController::class,'show_comments'])->name('comments');
    Route::get('/edit-comment/{comment_id}',    [UsersController::class,'edit_comment'])->name('comment.edit');
    Route::put('/edit-comment/{comment_id}',    [UsersController::class,'update_comment'])->name('comment.update');

    Route::delete('/delete-comment/{comment_id}',[UsersController::class,'destroy_comment'])->name('comment.destroy');

});
});

Route::group(['prefix' => 'admin'], function() {
    // Authentication Routes...
    Route::get('/login',                            [App\Http\Controllers\Backend\Auth\LoginController::class,'showLoginForm'])->name('admin.show_login_form');
    Route::post('login',                            [App\Http\Controllers\Backend\Auth\LoginController::class,'login'])->name('admin.login');
    Route::post('logout',                           [App\Http\Controllers\Backend\Auth\LoginController::class,'logout'])->name('admin.logout');
    Route::get('password/reset',                    [App\Http\Controllers\Backend\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email',                   [App\Http\Controllers\Backend\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}',            [App\Http\Controllers\Backend\Auth\ResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset',                   [App\Http\Controllers\Backend\Auth\ResetPasswordController::class,'reset'])->name('admin.password.update');
});

Route::get('/contact-us',                           [App\Http\Controllers\Frontend\IndexController::class,'contact'])->name('frontend.contact');
Route::post('/contact-us',                          [App\Http\Controllers\Frontend\IndexController::class,'do_contact'])->name('frontend.do_contact');
Route::get('/category/{category_slug}',             [App\Http\Controllers\Frontend\IndexController::class,'category'])->name('frontend.category.posts');
Route::get('/archive/{date}',                       [App\Http\Controllers\Frontend\IndexController::class,'archive'])->name('frontend.archive.posts');
Route::get('/author/{username}',                    [App\Http\Controllers\Frontend\IndexController::class,'author'])->name('frontend.author.posts');
Route::get('/search',                               [App\Http\Controllers\Frontend\IndexController::class,'search'])->name('frontend.search');
Route::get('/{post}',                               [App\Http\Controllers\Frontend\IndexController::class,'post_show'])->name('posts.show');
Route::post('/{post}',                              [App\Http\Controllers\Frontend\IndexController::class,'store_comment'])->name('posts.add_comment');


