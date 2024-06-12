<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AssociationController;

Route::post('/store', [AssociationController::class, "store"]);
Route::post('/getName', [AssociationController::class, "getName"]);
