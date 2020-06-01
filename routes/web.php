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

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

// Backend
Route::group(['as'=>'app.','prefix'=>'app','namespace' => 'Backend','middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Roles and Users
    Route::resource('roles', 'RoleController')->except(['show']);
    Route::resource('users', 'UserController');

    // Backups
    Route::resource('backups', 'BackupController')->only(['index','store','destroy']);
    Route::get('backups/{file_name}', 'BackupController@download')->name('backups.download');
    Route::delete('backups', 'BackupController@clean')->name('backups.clean');

    // Profile
    Route::get('profile/', 'ProfileController@index')->name('profile.index');
    Route::post('profile/', 'ProfileController@update')->name('profile.update');

    // Security
    Route::get('profile/security', 'ProfileController@changePassword')->name('profile.password.change');
    Route::post('profile/security', 'ProfileController@updatePassword')->name('profile.password.update');

    // Pages
    Route::resource('pages', 'PageController')->except(['show']);

    // Menu Builder
    Route::resource('menus', 'MenuController')->except(['show']);
    Route::post('menus/{menu}/order', 'MenuController@orderItem')->name('menus.order');
    Route::group(['as'=>'menus.','prefix'=>'menus/{id}/'], function () {
        Route::get('builder', 'MenuBuilderController@index')->name('builder');
        // Menu Item
        Route::group(['as'=>'item.','prefix'=>'item'], function () {
            Route::get('/create', 'MenuBuilderController@itemCreate')->name('create');
            Route::post('/store', 'MenuBuilderController@itemStore')->name('store');
            Route::get('/{itemId}/edit', 'MenuBuilderController@itemEdit')->name('edit');
            Route::put('/{itemId}/update', 'MenuBuilderController@itemUpdate')->name('update');
            Route::delete('/{itemId}/destroy', 'MenuBuilderController@itemDestroy')->name('destroy');
        });
    });

    // Settings
    Route::group(['as'=>'settings.','prefix'=>'settings'], function () {
        Route::get('general', 'SettingController@index')->name('index');
        Route::put('general', 'SettingController@update')->name('update');

        Route::get('logo','SettingController@logo')->name('logo.index');
        Route::put('logo','SettingController@updateLogo')->name('logo.update');

        Route::get('mail','SettingController@mail')->name('mail.index');
        Route::put('mail','SettingController@updateMailSettings')->name('mail.update');
    });
});
