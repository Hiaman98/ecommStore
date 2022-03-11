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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/logout", "Admin\AdminController@logout")->name("logout");

Route::prefix("admin")->namespace("Admin")->group(function() {
    Route::match(["get", "post"], "/", "AdminController@login")->name("login");

    Route::group(["middleware"=> ["admin"]], function() 
    {
        Route::get("dashboard", "AdminController@dashboard")->name("dashboard");
        Route::get("settings", "AdminController@settings")->name("admin.settings");
    });
});
