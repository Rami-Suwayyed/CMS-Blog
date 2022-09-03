<?php

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
Route::get('/',                                 ['as' => 'frontend.index',      'uses' => 'App\Http\Controllers\Frontend\IndexController@index']);


// Authentication Routes...
Route::get('/login',                            ['as' => 'frontend.show_login_form',        'uses' => 'App\Http\Controllers\Frontend\Auth\LoginController@showLoginForm']);
Route::post('login',                            ['as' => 'frontend.login',                  'uses' => 'App\Http\Controllers\Frontend\Auth\LoginController@login']);
Route::post('logout',                           ['as' => 'frontend.logout',                 'uses' => 'App\Http\Controllers\Frontend\Auth\LoginController@logout']);
Route::get('register',                          ['as' => 'frontend.show_register_form',     'uses' => 'App\Http\Controllers\Frontend\Auth\RegisterController@showRegistrationForm']);
Route::post('register',                         ['as' => 'frontend.register',               'uses' => 'App\Http\Controllers\Frontend\Auth\RegisterController@register']);
Route::get('password/reset',                    ['as' => 'password.request',                'uses' => 'App\Http\Controllers\Frontend\Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email',                   ['as' => 'password.email',                  'uses' => 'App\Http\Controllers\Frontend\Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}',            ['as' => 'password.reset',                  'uses' => 'App\Http\Controllers\Frontend\Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset',                   ['as' => 'password.update',                 'uses' => 'App\Http\Controllers\Frontend\Auth\ResetPasswordController@reset']);
Route::get('email/verify',                      ['as' => 'verification.notice',             'uses' => 'App\Http\Controllers\Frontend\Auth\VerificationController@show']);
Route::get('/email/verify/{id}/{hash}',         ['as' => 'verification.verify',             'uses' => 'App\Http\Controllers\Frontend\Auth\VerificationController@verify']);
Route::post('email/resend',                     ['as' => 'verification.resend',             'uses' => 'App\Http\Controllers\Frontend\Auth\VerificationController@resend']);


Route::group(['middleware' => 'verified'], function () {
    Route::get('/dashboard',                    ['as' => 'frontend.dashboard',              'uses' => 'App\Http\Controllers\Frontend\UsersController@index']);

    Route::any('user/notifications/get', 'App\Http\Controllers\Frontend\NotificationsController@getNotifications');
    Route::any('user/notifications/read', 'App\Http\Controllers\Frontend\NotificationsController@markAsRead');
    Route::any('user/notifications/read/{id}', 'App\Http\Controllers\Frontend\NotificationsController@markAsReadAndRedirect');


    Route::get('/edit-info',                    ['as' => 'users.edit_info',                 'uses' => 'App\Http\Controllers\Frontend\UsersController@edit_info']);
    Route::post('/edit-info',                   ['as' => 'users.update_info',               'uses' => 'App\Http\Controllers\Frontend\UsersController@update_info']);
    Route::post('/edit-password',               ['as' => 'users.update_password',           'uses' => 'App\Http\Controllers\Frontend\UsersController@update_password']);


    Route::get('/create-post',                  ['as' => 'users.post.create',               'uses' => 'App\Http\Controllers\Frontend\UsersController@create_post']);
    Route::post('/create-post',                 ['as' => 'users.post.store',                'uses' => 'App\Http\Controllers\Frontend\UsersController@store_post']);

    Route::get('/edit-post/{post_id}',          ['as' => 'users.post.edit',                 'uses' => 'App\Http\Controllers\Frontend\UsersController@edit_post']);
    Route::put('/edit-post/{post_id}',          ['as' => 'users.post.update',               'uses' => 'App\Http\Controllers\Frontend\UsersController@update_post']);

    Route::delete('/delete-post/{post_id}',     ['as' => 'users.post.destroy',              'uses' => 'App\Http\Controllers\Frontend\UsersController@destroy_post']);
    Route::post('/delete-post-media/{media_id}',['as' => 'users.post.media.destroy',        'uses' => 'App\Http\Controllers\Frontend\UsersController@destroy_post_media']);

    Route::get('/comments',                     ['as' => 'users.comments',                  'uses' => 'App\Http\Controllers\Frontend\UsersController@show_comments']);
    Route::get('/edit-comment/{comment_id}',    ['as' => 'users.comment.edit',                 'uses' => 'App\Http\Controllers\Frontend\UsersController@edit_comment']);
    Route::put('/edit-comment/{comment_id}',    ['as' => 'users.comment.update',               'uses' => 'App\Http\Controllers\Frontend\UsersController@update_comment']);

    Route::delete('/delete-comment/{comment_id}',['as' => 'users.comment.destroy',              'uses' => 'App\Http\Controllers\Frontend\UsersController@destroy_comment']);

});



Route::group(['prefix' => 'admin'], function() {
    // Authentication Routes...
    Route::get('/login',                            ['as' => 'admin.show_login_form',       'uses' => 'App\Http\Controllers\Backend\Auth\LoginController@showLoginForm']);
    Route::post('login',                            ['as' => 'admin.login',                 'uses' => 'App\Http\Controllers\Backend\Auth\LoginController@login']);
    Route::post('logout',                           ['as' => 'admin.logout',                'uses' => 'App\Http\Controllers\Backend\Auth\LoginController@logout']);
    Route::get('password/reset',                    ['as' => 'admin.password.request',      'uses' => 'App\Http\Controllers\Backend\Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email',                   ['as' => 'admin.password.email',        'uses' => 'App\Http\Controllers\Backend\Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}',            ['as' => 'admin.password.reset',        'uses' => 'App\Http\Controllers\Backend\Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset',                   ['as' => 'admin.password.update',       'uses' => 'App\Http\Controllers\Backend\Auth\ResetPasswordController@reset']);

    Route::group(['middleware' => ['roles', 'role:admin|editor']], function() {
        Route::any('/notifications/get', 'App\Http\Controllers\Backend\NotificationsController@getNotifications');
        Route::any('/notifications/read', 'App\Http\Controllers\Backend\NotificationsController@markAsRead');
        Route::any('/notifications/read/{id}', 'App\Http\Controllers\Backend\NotificationsController@markAsReadAndRedirect');


        Route::get('/',                             ['as' => 'admin.index_route',           'uses' => 'App\Http\Controllers\Backend\AdminController@index']);
        Route::get('/index',                        ['as' => 'admin.index',                 'uses' => 'App\Http\Controllers\Backend\AdminController@index']);

        Route::post('/posts/removeImage/{media_id}',['as' => 'admin.posts.media.destroy', 'uses' => 'App\Http\Controllers\Backend\PostsController@removeImage']);
        Route::resource('posts',                    'App\Http\Controllers\Backend\PostsController', ['as' => 'admin']);

        Route::post('/pages/removeImage/{media_id}',['as' => 'admin.pages.media.destroy', 'uses' => 'App\Http\Controllers\Backend\PagesController@removeImage']);
        Route::resource('pages',                    'App\Http\Controllers\Backend\PagesController', ['as' => 'admin']);

        Route::resource('post_comments',            'App\Http\Controllers\Backend\PostCommentsController', ['as' => 'admin']);
        Route::resource('post_categories',          'App\Http\Controllers\Backend\PostCategoriesController', ['as' => 'admin']);

        Route::resource('contact_us',               'App\Http\Controllers\Backend\ContactUsController', ['as' => 'admin']);

        Route::post('/users/removeImage',           ['as' => 'admin.users.remove_image', 'uses' => 'App\Http\Controllers\Backend\UsersController@removeImage']);
        Route::resource('users',                    'App\Http\Controllers\Backend\UsersController', ['as' => 'admin']);
        Route::post('/supervisors/removeImage',     ['as' => 'admin.supervisors.remove_image', 'uses' => 'App\Http\Controllers\Backend\SupervisorsController@removeImage']);
        Route::resource('supervisors',              'App\Http\Controllers\Backend\SupervisorsController', ['as' => 'admin']);

        Route::resource('settings',                 'App\Http\Controllers\Backend\SettingsController', ['as' => 'admin']);

    });

});

Route::get('/contact-us',                       ['as' => 'frontend.contact',                'uses' => 'App\Http\Controllers\Frontend\IndexController@contact']);
Route::post('/contact-us',                      ['as' => 'frontend.do_contact',             'uses' => 'App\Http\Controllers\Frontend\IndexController@do_contact']);
Route::get('/category/{category_slug}',         ['as' => 'frontend.category.posts',         'uses' => 'App\Http\Controllers\Frontend\IndexController@category']);
Route::get('/archive/{date}',                   ['as' => 'frontend.archive.posts',          'uses' => 'App\Http\Controllers\Frontend\IndexController@archive']);
Route::get('/author/{username}',                ['as' => 'frontend.author.posts',           'uses' => 'App\Http\Controllers\Frontend\IndexController@author']);
Route::get('/search',                           ['as' => 'frontend.search',                 'uses' => 'App\Http\Controllers\Frontend\IndexController@search']);
Route::get('/{post}',                           ['as' => 'posts.show',                      'uses' => 'App\Http\Controllers\Frontend\IndexController@post_show']);
Route::post('/{post}',                          ['as' => 'posts.add_comment',               'uses' => 'App\Http\Controllers\Frontend\IndexController@store_comment']);
