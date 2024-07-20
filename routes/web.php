<?php

use App\Http\Controllers\Site\Advertisement\AdvertisementCreateController;
use App\Http\Controllers\Site\Home\FrontHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\LoginController;
// use App\Http\Controllers\User\SiteUserQueryController;





Route::get('/registration', [HomeController::class, "registrationPage"])->name("registrationPage");
Route::post('/registrationCode', [HomeController::class, "registration"])->name("registration");

Route::get('/registrationConfirmPage/{id}', [HomeController::class, "registrationConfirmPage"])->name("registrationConfirmPage");
Route::post('/registrationConfirm/{id}', [HomeController::class, "registrationConfirm"])->name("registrationConfirm");

// if user not login work this links
Route::group(["middleware" => "userNotLogin"], function () {
    Route::get('/login', [LoginController::class, "loginPage"])->name("loginPage");
    Route::post('/login', [LoginController::class, "login"])->name("login");

    Route::get('/loginConfirmPage/{id}', [LoginController::class, "loginConfirmPage"])->name("loginConfirmPage");
    Route::post('/loginConfirm/{id}', [LoginController::class, "loginConfirm"])->name("loginConfirm");
});

Route::get('/logout', [LoginController::class, "logout"])->name("logout");


// Route::get('/', [HomeController::class, "index"])->name("index");

Route::get('/advertisement', [AdvertisementCreateController::class, "index"])->name("createAdvertisementPage");
Route::post('/advertisement', [AdvertisementCreateController::class, "store"])->name("createAdvertisement");


//siteHome
Route::get('/', [FrontHomeController::class, "index"])->name("homeIndex");
Route::get('/show/{id}', [FrontHomeController::class, "show"])->name("showAdvertisement");
