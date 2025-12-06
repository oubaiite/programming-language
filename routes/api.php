<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');



Route::delete('removeUser',[UserController::class,'deleteUser'])->middleware(['auth:sanctum','CheckAdmin']);
Route::get('getaAllUser',[UserController::class,'getaAllUser']);

Route::post('postApartment', [ApartmentController::class, 'postApartment'])->middleware(['auth:sanctum', 'CheckUserRole']);
Route::post('valuation',[ApartmentController::class,'valuation']);
Route::get('getApartments',[ApartmentController::class,'getAllApartments']);
Route::get('notifications',[UserController::class,'getNotificatios'])->middleware(['auth:sanctum', 'CheckUserRole']);
Route::post('notifications/{id}/read',[UserController::class,'markAsRead'])->middleware(['auth:sanctum', 'CheckUserRole']);;
Route::get('/test',[Controller::class,'test']);
Route::get('language/{locale}',[UserController::class,'selectLanguage']);
