<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TombolaController;

use App\Models\Tombola;

Route::post("/getAll", [TombolaController::class, "getAll"]);
Route::get("/getAll", [TombolaController::class, "getAll"]);
Route::post("/getAllEnCoursByIdAsso", [TombolaController::class, "getAllEnCoursByIdAsso"]);
Route::post("/getAllByIdAsso", [TombolaController::class, "getAllByIdAsso"]);
Route::post("/store", [TombolaController::class, "store"]);
Route::get("/store", [TombolaController::class, "store"]);