<?php

use App\Http\Controllers\ProductsController;
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
//  Dynamic routing
// Route::get('/user/{id}/{name}', function ($id, $name) {
//     return 'The user is '.$name. 'with id'. $id;
// });

// php methods such as  get, post, put, path, delete, options,
// laravel methods such as view, redirect, any
// Here, get method is using 2 parameter: /, and a function. i>which route/url and execute the function ii>anonymous fuction
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return view('pages.about');
// });

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

// Creates routes for all the resource in CRUD
Route::resource('posts','PostsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

