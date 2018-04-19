<?php

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

use Illuminate\Database\Schema\Blueprint;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('admin_layouts.dashboard.dashboard');
    });
    Route::get('/dashboard', function () {
        return view('admin_layouts.dashboard.dashboard');
    });
    Route::prefix('blog')->name('blog.')->group(function (){
        Route::get('/', 'admin_controller\BlogController@index')->name('index');
        Route::post('/get-all-post', 'admin_controller\BlogController@getAllPost')->name('getAllPostAjax');
        Route::delete('/soft-delete', 'admin_controller\BlogController@softDelete')->name('softDeleteAjax');
        Route::post('/force-delete', 'admin_controller\BlogController@forceDelete')->name('forceDeleteAjax');
        Route::post('/restore', 'admin_controller\BlogController@restore')->name('restoreAjax');
        Route::get('/create', 'admin_controller\BlogController@create')->name('create');
        Route::post('/store', 'admin_controller\BlogController@store')->name('store');
        Route::get('/edit/{id}', 'admin_controller\BlogController@edit')->name('edit');
        Route::put('/update/{id}', 'admin_controller\BlogController@update')->name('update');
    });
    Route::prefix('media')->name('media.')->group(function (){
        Route::get('/','admin_controller\MediaController@index')->name('index');
        Route::post('/store','admin_controller\MediaController@store')->name('store');
        Route::get('/get-all-file','admin_controller\MediaController@get_file_ajax')->name('get_file_ajax');
        Route::put('/update-file','admin_controller\MediaController@update')->name('update');
        Route::delete('/delete-file','admin_controller\MediaController@delete')->name('delete');
    });
    Route::prefix('taxonomy')->name('taxonomy.')->group(function (){
        Route::get('/categories','admin_controller\TaxonomyController@categories')->name('categories');
        Route::get('/tags','admin_controller\TaxonomyController@tags')->name('tags');
        Route::get('/edit/{id}','admin_controller\TaxonomyController@edit')->name('taxonomy_edit');
        Route::put('/update/{id}','admin_controller\TaxonomyController@update')->name('taxonomy_update');
        Route::delete('/delete','admin_controller\TaxonomyController@delete')->name('taxonomy_delete');

        Route::post('/store','admin_controller\TaxonomyController@store')->name('store');
        Route::get('/get-categories-list','admin_controller\TaxonomyController@getCateList')->name('getCategoriesList');
        Route::get('/get-tags-list','admin_controller\TaxonomyController@getTagList')->name('getTagsList');
    });
    Route::prefix('comments')->name('comments.')->group(function (){
        Route::get('/blog/{id}','admin_controller\CommentController@blogsComments')->name('post_comment');
    });
});


Route::get('/','user_controller\HomeController@index');
//phải đặt route cho page ở trên route có biến taxonomy_slug thì sẽ ko bị hiểu lầm trang page là trang category => Route có thứ tự ưu tiên.
//các route page mặc định phải đặt ở đây.
Route::get('/about',function(){
    return view('user_layouts.about');
});

//
Route::post('/comment/{blog_slug}','user_controller\CommentController@getComments')->name('getComments');
Route::get('/{taxonomy_slug}','user_controller\TaxonomyController@index');
Route::get('/{taxonomy_slug}/{post_slug}','user_controller\PostController@index');

