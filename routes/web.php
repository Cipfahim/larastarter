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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Backend routes
Route::group(['as'=>'app.','prefix'=>'app','namespace' => 'Backend','middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Roles and Users Routes
    Route::resource('roles', 'RoleController')->except(['show']);
    Route::resource('users', 'UserController')->except(['show']);

    // Pages routes
    Route::resource('pages', 'PageController')->except(['show']);

    // User Profile and Password Routes
    Route::group(['as'=>'profile.','prefix'=>'profile'], function () {
        Route::get('/', 'ProfileController@index')->name('index');
        Route::post('/', 'ProfileController@update')->name('update');

        Route::get('/change-password', 'ProfileController@changePassword')->name('password.change');
        Route::post('/update-password', 'ProfileController@updatePassword')->name('password.update');
    });

    // Menu Builder Routes
    Route::resource('menus', 'MenuController')->except(['show']);
    Route::post('menus/{menu}/order', 'MenuController@orderItem')->name('menus.order');
    Route::group(['as'=>'menus.','prefix'=>'menus/{id}/'], function () {
        Route::get('builder', 'MenuBuilderController@index')->name('builder');
        // Menu Item Routes
        Route::group(['as'=>'item.','prefix'=>'item'], function () {
            Route::get('/create', 'MenuBuilderController@itemCreate')->name('create');
            Route::post('/store', 'MenuBuilderController@itemStore')->name('store');
            Route::get('/{itemId}/edit', 'MenuBuilderController@itemEdit')->name('edit');
            Route::put('/{itemId}/update', 'MenuBuilderController@itemUpdate')->name('update');
            Route::delete('/{itemId}/destroy', 'MenuBuilderController@itemDestroy')->name('destroy');
        });
    });

    // Settings Routes
    Route::get('settings/general', 'SettingController@index')->name('settings.index');
    Route::put('settings/general', 'SettingController@update')->name('settings.update');
});
