<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TableController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/table',[TableController::class,"GetAllTable"]);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('food',FoodController::class);

    Route::get('/orders', [OrderController::class, 'index']);     
    Route::post('/orders', [OrderController::class, 'store']);   
    Route::patch('/orders/{id}/complete', [OrderController::class, 'completeOrder']); 

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
