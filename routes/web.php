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

Route::get("/", ["App\Http\Controllers\HomeController", "index"])->name("home");

Auth::routes();

Route::get("/backend", function () {
    return view("backend.index");
})
  ->middleware("Admin")
  ->name("backend");

Route::resource(
    "/backend/pages",
    "App\Http\Controllers\Backend\PagesController",
    ["except" => ["show"]]
);

Route::resource(
    "/backend/blog",
    "App\Http\Controllers\Backend\BlogController",
    ["except" => ["show"]]
);

Route::resource(
    "/backend/users",
    "App\Http\Controllers\Backend\UsersController",
    ["except" => ["create", "store", "show"]]
);
