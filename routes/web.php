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

use Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Auth::routes();

Route::get('/', function () {
    if(Auth::check()) {
        return redirect()->route('backend::dashboard.index');
    } else {
        return redirect('login');
    }
});

Route::group(['as' => 'backend::', 'prefix' => 'backend', 'namespace' => 'Backend', 'middleware' => 'auth' ], function () {
    Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
    Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard', 'middleware' => 'auth' ], function () {
        Route::get('/search', ['as' => 'search', 'uses' => 'DashboardController@search']);
        Route::post('/select-petani', ['as' => 'selectPetani', 'uses' => 'DashboardController@selectPetani']);
        Route::post('/get-price', ['as' => 'getPrice', 'uses' => 'DashboardController@getPrice']);
        Route::post('/store', ['as' => 'store', 'uses' => 'DashboardController@store']);
    });

    Route::delete('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    Route::group(['as' => 'profile.', 'prefix' => 'profile', 'middleware' => 'auth' ], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ProfileController@index']);
        Route::put('/update', ['as' => 'update', 'uses' => 'ProfileController@update']);
        Route::put('/password', ['as' => 'password', 'uses' => 'ProfileController@password']);
    });

    Route::group(['as' => 'profile.', 'prefix' => 'profile', 'middleware' => 'auth' ], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ProfileController@index']);
        Route::put('/update', ['as' => 'update', 'uses' => 'ProfileController@update']);
        Route::put('/password', ['as' => 'password', 'uses' => 'ProfileController@password']);
    });

    Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => 'auth' ], function () {
        Route::get('/', ['as' => 'index', 'middleware' => 'access:index,backend/user', 'uses' => 'UserController@index']);
        Route::get('/datatables', ['as' => 'datatables', 'middleware' => 'access:index,backend/user', 'uses' => 'UserController@datatables']);
        Route::get('/create', ['as' => 'create', 'middleware' => 'access:create,backend/user', 'uses' => 'UserController@create']);
        Route::post('/create', ['as' => 'store', 'middleware' => 'access:create,backend/user', 'uses' => 'UserController@store']);
        Route::get('/detail/{id}', ['as' => 'detail', 'middleware' => 'access:detail,backend/user', 'uses' => 'UserController@detail']);
        Route::get('/edit/{id}', ['as' => 'edit', 'middleware' => 'access:edit,backend/user', 'uses' => 'UserController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'middleware' => 'access:edit,backend/user', 'uses' => 'UserController@update']);
        Route::get('/delete/{id}', ['as' => 'delete', 'middleware' => 'access:delete,backend/user', 'uses' => 'UserController@delete']);
        Route::delete('/delete/{id}', ['as' => 'destroy', 'middleware' => 'access:delete,backend/user', 'uses' => 'UserController@destroy']);
        Route::post('/change-status', ['as' => 'changeStatus', 'middleware' => 'access:edit,backend/user', 'uses' => 'UserController@changeStatus']);
    });

    Route::group(['as' => 'role.', 'prefix' => 'role', 'middleware' => 'auth' ], function () {
        Route::get('/', ['as' => 'index', 'middleware' => 'access:index,backend/role', 'uses' => 'RoleController@index']);
        Route::get('/datatables', ['as' => 'datatables', 'middleware' => 'access:index,backend/role', 'uses' => 'RoleController@datatables']);
        Route::get('/create', ['as' => 'create', 'middleware' => 'access:create,backend/role', 'uses' => 'RoleController@create']);
        Route::post('/create', ['as' => 'store', 'middleware' => 'access:create,backend/role', 'uses' => 'RoleController@store']);
        Route::get('/detail/{id}', ['as' => 'detail', 'middleware' => 'access:detail,backend/role', 'uses' => 'RoleController@detail']);
        Route::get('/edit/{id}', ['as' => 'edit', 'middleware' => 'access:edit,backend/role', 'uses' => 'RoleController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'middleware' => 'access:edit,backend/role', 'uses' => 'RoleController@update']);
        Route::get('/delete/{id}', ['as' => 'delete', 'middleware' => 'access:delete,backend/role', 'uses' => 'RoleController@delete']);
        Route::delete('/delete/{id}', ['as' => 'destroy', 'middleware' => 'access:delete,backend/role', 'uses' => 'RoleController@destroy']);
    });

    Route::group(['as' => 'kategori.', 'prefix' => 'kategori', 'middleware' => 'auth' ], function () {
        Route::get('/', ['as' => 'index', 'middleware' => 'access:index,backend/kategori', 'uses' => 'CategoryController@index']);
        Route::get('/datatables', ['as' => 'datatables', 'middleware' => 'access:index,backend/kategori', 'uses' => 'CategoryController@datatables']);
        Route::get('/create', ['as' => 'create', 'middleware' => 'access:create,backend/kategori', 'uses' => 'CategoryController@create']);
        Route::post('/create', ['as' => 'store', 'middleware' => 'access:create,backend/kategori', 'uses' => 'CategoryController@store']);
        Route::get('/detail/{id}', ['as' => 'detail', 'middleware' => 'access:detail,backend/kategori', 'uses' => 'CategoryController@detail']);
        Route::get('/edit/{id}', ['as' => 'edit', 'middleware' => 'access:edit,backend/kategori', 'uses' => 'CategoryController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'middleware' => 'access:edit,backend/kategori', 'uses' => 'CategoryController@update']);
        Route::get('/delete/{id}', ['as' => 'delete', 'middleware' => 'access:delete,backend/kategori', 'uses' => 'CategoryController@delete']);
        Route::delete('/delete/{id}', ['as' => 'destroy', 'middleware' => 'access:delete,backend/kategori', 'uses' => 'CategoryController@destroy']);
    });

    Route::group(['as' => 'produk.', 'prefix' => 'produk', 'middleware' => 'auth' ], function () {
        Route::get('/', ['as' => 'index', 'middleware' => 'access:index,backend/produk', 'uses' => 'ProductController@index']);
        Route::get('/datatables', ['as' => 'datatables', 'middleware' => 'access:index,backend/produk', 'uses' => 'ProductController@datatables']);
        Route::get('/create', ['as' => 'create', 'middleware' => 'access:create,backend/produk', 'uses' => 'ProductController@create']);
        Route::post('/create', ['as' => 'store', 'middleware' => 'access:create,backend/produk', 'uses' => 'ProductController@store']);
        Route::get('/detail/{id}', ['as' => 'detail', 'middleware' => 'access:detail,backend/produk', 'uses' => 'ProductController@detail']);
        Route::get('/edit/{id}', ['as' => 'edit', 'middleware' => 'access:edit,backend/produk', 'uses' => 'ProductController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'middleware' => 'access:edit,backend/produk', 'uses' => 'ProductController@update']);
        Route::get('/delete/{id}', ['as' => 'delete', 'middleware' => 'access:delete,backend/produk', 'uses' => 'ProductController@delete']);
        Route::delete('/delete/{id}', ['as' => 'destroy', 'middleware' => 'access:delete,backend/produk', 'uses' => 'ProductController@destroy']);
    });

    Route::group(['as' => 'pengaturan.', 'prefix' => 'pengaturan', 'middleware' => 'auth' ], function () {
        Route::get('/', ['as' => 'index', 'middleware' => 'access:index,backend/pengaturan', 'uses' => 'SettingController@index']);
        Route::post('/edit', ['as' => 'update', 'middleware' => 'access:edit,backend/pengaturan', 'uses' => 'SettingController@update']);
    });
});
