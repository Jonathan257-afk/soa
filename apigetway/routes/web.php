<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

Route::post('/', [ApiController::class, "index"])->name("index");
Route::get('/', [ApiController::class, "index"]);