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
        Route::post("check/current/password", "AdminController@checkCurrentPassword")->name("admin.check.current.password");
        Route::post("update/current/password", "AdminController@updateCurrentPassword")->name("admin.update.password");
        Route::match(["get", "post"], "update/details", "AdminController@updateAdminDetails")->name("update.admin.details");
        Route::get("section", "SectionController@index")->name("admin.section.index");
        Route::get("section/datatable", "SectionController@dataTable")->name("admin.section.table");
        Route::post("update-section/{id}/status", "SectionController@updateSectionStatus")->name("update.section.status");
        // Category Routes
        Route::get("category", "CategoryController@index")->name("admin.category.index");
        Route::match(["get", "post"], "add/category", "CategoryController@store")->name("admin.category.add");
        Route::get("category/datatable", "CategoryController@dataTable")->name("admin.category.table");
        Route::post("update-category/{id}/status", "CategoryController@updateCategoryStatus")->name("update.category.status");

    });
});
