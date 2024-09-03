<?php

use App\Http\Controllers\ReserveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Reserve;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([

    'reserve'=>ReserveController::class, 

]);
