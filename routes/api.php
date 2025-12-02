<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');



Route::delete('removeUser',[UserController::class,'deleteUser']);
Route::get('getaAllUser',[UserController::class,'getaAllUser']);


Route::post('postApartment',[ApartmentController::class,'postApartment'])->middleware('auth:sanctum');
Route::post('valuation',[ApartmentController::class,'valuation']);
Route::get('getApartments',[ApartmentController::class,'getAllApartments']);
