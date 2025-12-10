<?php

use App\Http\Controllers\AdminController;
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

Route::middleware(['auth:sanctum','CheckAdmin'])->group(function () {;
    Route::get('/pending-users', [AdminController::class, 'listPending']);
    Route::post('/pending-users/approve', [AdminController::class, 'approve']);
    Route::post('/pending-users/reject', [AdminController::class, 'reject']);
    Route::delete('removeUser/{id}',[AdminController::class,'deleteUser']);
    Route::get('getaAllUser',[AdminController::class,'getaAllUser']);
});
Route::middleware(['auth:sanctum', 'CheckUserRole'])->group(function()
{
Route::post('valuation',[ApartmentController::class,'valuation']);
Route::post('postApartment', [ApartmentController::class, 'postApartment']);
Route::get('getApartments',[ApartmentController::class,'getAllApartments']);
});
Route::get('notifications',[UserController::class,'getNotificatios'])->middleware(['auth:sanctum', 'CheckUserRole']);
Route::post('notifications/{id}/read',[UserController::class,'markAsRead'])->middleware(['auth:sanctum', 'CheckUserRole']);;
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::get('/test',[Controller::class,'test']);
Route::get('language/{locale}',[UserController::class,'selectLanguage']);
