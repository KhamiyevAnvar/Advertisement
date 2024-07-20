<?php

use App\Http\Controllers\CarModel\CarModelQueryController;
use App\Http\Controllers\Car\CarCommandController;
use App\Http\Controllers\Car\CarQueryController;
use App\Http\Controllers\CarModel\CarModelCommandController;
use App\Http\Controllers\dashboard\advertisement\AdvertisementCommandController;
use App\Http\Controllers\dashboard\advertisement\AdvertisementQueryController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\AuthController;
use App\Http\Controllers\Report\ReportQueryController;
use App\Http\Controllers\SiteAdmin\SiteAdminQueryController;
use App\Http\Controllers\SiteUser\SiteUserQueryController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "notLogin"], function () {
    Route::get('/home', [HomeController::class, "index"])->name("home");

    Route::get('/logout', [AuthController::class, "logout"])->name("logout");

    // car
    Route::group(["prefix" => "car", "as" => "car."], function () {
        // query
        Route::get('/create', [CarQueryController::class, "create"])->name("create");
        Route::get('/index', [CarQueryController::class, "index"])->name("index");
        Route::get('/deleted', [CarQueryController::class, "deleted"])->name("deleted");
        Route::get('/edit/{id}', [CarQueryController::class, "edit"])->name("edit");

        // command
        Route::post('/store', [CarCommandController::class, "store"])->name("store");
        Route::get('/resetFilter', [CarCommandController::class, "resetFilter"])->name("resetFilter");
        Route::post('/update/{id}', [CarCommandController::class, "update"])->name("update");
        Route::get('/deletedBack/{id}', [CarCommandController::class, "deletedBack"])->name("deletedBack");
        Route::get('/delete/{id}', [CarCommandController::class, "delete"])->name("delete");


        // test image
        Route::get('/image', [CarQueryController::class, "imageView"])->name("imageView");
        Route::post('/image', [CarCommandController::class, "imageUploads"])->name("imageUploads");
    });

    // Car model
    Route::group(["prefix" => "car-model", "as" => "car-model."], function () {
        // query
        Route::get('/create', [CarModelQueryController::class, "create"])->name("create");
        Route::get('/index', [CarModelQueryController::class, "index"])->name("index");
        Route::get('/deleted', [CarModelQueryController::class, "deleted"])->name("deleted");
        Route::get('/edit/{id}', [CarModelQueryController::class, "edit"])->name("edit");

        // command
        Route::post('/store', [CarModelCommandController::class, "store"])->name("store");
        Route::get('/resetFilter', [CarModelCommandController::class, "resetFilter"])->name("resetFilter");
        Route::post('/update/{id}', [CarModelCommandController::class, "update"])->name("update");
        Route::get('/deletedBack/{id}', [CarModelCommandController::class, "deletedBack"])->name("deletedBack");
        Route::get('/delete/{id}', [CarModelCommandController::class, "delete"])->name("delete");
    });

    Route::group(["prefix" => "site-user", "as" => "site-user."], function () {
        Route::get('/index', [SiteUserQueryController::class, "index"])->name("index");
    });


    Route::group(["prefix" => "report", "as" => "report."], function () {
        Route::get('/montly', [ReportQueryController::class, "montly"])->name("montly");
    });



    // Car model
    Route::group(["prefix" => "site-admin", "as" => "site-admin."], function () {
        // query
        Route::get('/create', [SiteAdminQueryController::class, "createPage"])->name("createPage");
        Route::get('/index', [SiteAdminQueryController::class, "index"])->name("index");
        // Route::get('/deleted', [CarModelQueryController::class, "deleted"])->name("deleted");
        Route::get('/edit/{id}', [SiteAdminQueryController::class, "edit"])->name("edit");

        // command
        Route::post('/create', [SiteAdminQueryController::class, "create"])->name("create");
        // Route::get('/resetFilter', [CarModelCommandController::class, "resetFilter"])->name("resetFilter");
        Route::post('/update/{id}', [SiteAdminQueryController::class, "update"])->name("update");
        // Route::get('/deletedBack/{id}', [CarModelCommandController::class, "deletedBack"])->name("deletedBack");
        Route::get('/delete/{id}', [SiteAdminQueryController::class, "delete"])->name("delete");
    });


    Route::group(["prefix" => "advertisement", "as" => "advertisement."], function () {
        Route::get('/index', [AdvertisementQueryController::class, "index"])->name("index");

        Route::get('/show/{id}', [AdvertisementQueryController::class, "show"])->name("show");

        Route::get('/approve/{id}', [AdvertisementCommandController::class, "approve"])->name("approve");
        Route::get('/reject/{id}', [AdvertisementCommandController::class, "reject"])->name("reject");
    });
});


Route::group(["middleware" => "isLogin"], function () {
    Route::get('/login', [AuthController::class, "loginPage"])->name("loginPage");
    Route::post('/login', [AuthController::class, "login"])->name("login");
});
