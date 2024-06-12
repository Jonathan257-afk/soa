<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ReleveController;

use App\Models\Classe;

// Route::post("/authentification", [UserController::class, "authentificate"]);
// Route::get("/users", [UserController::class, "getAllUser"]);
// Route::post("/isConnected", [UserController::class, "getUserConnected"]);


// Route::middleware(['auth'])->group(function () {
//     // releve
//     Route::get("/releve/index", [ReleveController::class, "index"])->name("releve");
//     Route::post("/releve/add/csv", [ReleveController::class, "addByCsv"])->name("releve-add-csv");
//     Route::post("/releve/getAll", [ReleveController::class, "getAll"])->name("releve-getAll");
//     Route::post("/releve/add/pdf", [ReleveController::class, "addByPdf"])->name("releve-addByPdf");
//     // utilisateur 
//     Route::get("/user/index", [UserController::class, "index"])->name("user");
//     Route::get("/user/logout", [UserController::class, "logout"])->name("logout");
//     Route::post("/user/add", [UserController::class, "add"])->name("user-add");
//     Route::post("/user/remove", [UserController::class, "remove"])->name("user-delete");
//     //my accoount
//     Route::get("/user/my-account", [UserController::class, "myAccount"])->name("my-account");
//     Route::post("/user/update/my/info", [UserController::class, "updateInfo"])->name("user-update-info");
//     Route::post("/user/update/my/email", [UserController::class, "updateEmail"])->name("user-update-email");
//     Route::post("/user/update/my/password", [UserController::class, "updatePassword"])->name("user-update-password");
// });