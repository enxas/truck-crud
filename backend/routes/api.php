<?php

use App\Http\Controllers\TruckController;
use App\Http\Controllers\TruckSubunitController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('trucks', TruckController::class);
	Route::apiResource('subunits', TruckSubunitController::class);
});
