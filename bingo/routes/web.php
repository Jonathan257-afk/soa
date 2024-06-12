<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AssociationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TombolaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\BingoController;

use App\Models\Tombola;
use App\Models\Bingo;
use App\Models\Bingoticket;

Route::get("/test", function(){
   return  now();
});

Route::get('/', [IndexController::class, "index"])->name("index");

Route::get('/login', [UserController::class, "login"])->name("login");
Route::get('/logout', [UserController::class, "logout"])->name("logout");

Route::get("/create/account", [UserController::class, "selectSignIn"])->name("select-signIn");

Route::get("/user/create/account", [UserController::class, "userSignIn"])->name("userSignIn");
Route::get("/user/suggest/consult-mail", [UserController::class, "messageConsultMail"])->name("usermessageConsultMail");
Route::post('/user/signUp', [UserController::class, "signUp"])->name("user-signUp");

Route::get('/association/create/account', [AssociationController::class, "signIn"])->name("asso-signIn");
Route::post('/association/signUp', [AssociationController::class, "signUp"])->name("association-signUp");


Route::post('/authentificate', [UserController::class, "authentificate"])->name("authentificate");


Route::post("/tombola/get/byid", [TombolaController::class, "getById"])->name("get-tombola-by-id");
Route::get("/tombola/view/{id}", [TombolaController::class, "site"])->name("tombola-site");

Route::get("/bingo/tirage/{id}", [BingoController::class, "tirageMiniSite"])->name("mini-site-bingo-tirage");

Route::post("/bingo/get/byid", [BingoController::class, "getById"])->name("get-bingo-by-id");
Route::get("/bingo/view/{id}", [BingoController::class, "site"])->name("bingo-site");

Route::get("/account/confirm/{code}", [UserController::class, "confirmAccount"])->name("account.confirm");


Route::post("/getAllEnCoursByIdAsso", [BingoController::class, "getAllEnCoursByIdAsso"]);
Route::post("/getAllByIdAsso", [BingoController::class, "getAllByIdAsso"]);
Route::post("/store", [BingoController::class, "store"]);
Route::post("/getAll", [BingoController::class, "getAll"]);

//Route::middleware(['auth'])->group(function () {
    // user
    Route::get('/game', [IndexController::class, "game"])->name("game");

    Route::get('/user/dashboard', [DashboardController::class, "userDashboard"])->name("user-dashboard");
    Route::get('/user/achat', [UserController::class, "achat"])->name("user-achat");
    Route::get('/user/don', [UserController::class, "don"])->name("user-don");
    Route::get('/user/account', function () {
        return view("layouts/user/build");
    })->name("user-account");




    Route::post("/tombola/buy", [TombolaController::class, "buy"])->name("tombola-buy");
    Route::get("/tombola-buy/{id}", [TombolaController::class, "toBuy"])->name("tombola-to-buy");
    Route::get("/tombola-buy-success", [TombolaController::class, "buySuccess"])->name("buy-success");
    

    Route::get('/association/dashboard', [DashboardController::class, "assoDashboard"])->name("asso-dashboard");
    Route::get('/association/index', [AssociationController::class, "index"])->name("asso-index");
    Route::get('/association/mode-paiement', [AssociationController::class, "configPaiement"])->name("asso-configPaiement");

    Route::post('/association/update/info', [AssociationController::class, "updateInfo"])->name("asso-update-info");
    Route::post('/association/update/logo', [AssociationController::class, "updateLogo"])->name("asso-update-logo");
    Route::post('/association/update/paiement', [AssociationController::class, "updatePaiement"])->name("asso-update-paiement");
    
    Route::get('/association/tombola', [TombolaController::class, "index"])->name("asso-tombola");
    Route::get('/association/tombola/info/{id}', [TombolaController::class, "info"])->name("asso-tombola-info");
    Route::get('/association/tombola/add', [TombolaController::class, "add"])->name("asso-tombola-add");
    Route::post('/association/tombola/store', [TombolaController::class, "store"])->name("asso-tombola-store");
    
    Route::get('/association/don', [DonController::class, "index"])->name("asso-don");
    Route::post('/association/don/store', [DonController::class, "store"])->name("asso-don-store");

    Route::get('/association/shop', function () {
        return view("layouts/asso/build");
    })->name("asso-boutique");

    Route::post('/file/store/tmp', [FileController::class, "storeTmp"])->name("file-store-tmp");

    Route::get("/ticket/print/{id}", [AchatController::class, "printTicket"])->name("ticket-to-print");
    Route::get("/tickets/bingo/print/{id}", [AchatController::class, "printTicketBingoAllUser"])->name("tickets-user-bingo-to-print");
    Route::get("/ticket/bingo/print/{id}", [BingoController::class, "printTicket"])->name("ticket-user-bingo-to-print");
    //bingo
    Route::get('/association/bingo', [BingoController::class, "index"])->name("asso-bingo-index");
    Route::get('/association/bingo/info/{id}', [BingoController::class, "info"])->name("asso-bingo-info");
    Route::get('/association/bingo/add', [BingoController::class, "add"])->name("asso-bingo-add");
    Route::post('/association/bingo/store', [BingoController::class, "store"])->name("asso-bingo-store");
    Route::get("/bingo-buy/{id}", [BingoController::class, "toBuy"])->name("bingo-to-buy");
    Route::post("/bingo/buy", [BingoController::class, "buy"])->name("bingo-buy");
    Route::get("/bingo-buy-success", [BingoController::class, "buySuccess"])->name("bingo-buy-success");


    Route::get("/user/bingo-tirage/{id}", [BingoController::class, "tirageUser"])->name("user-bingo-tirage");
    Route::get("/asso/bingo-tirage/{id}", [BingoController::class, "tirageAsso"])->name("asso-bingo-tirage");
//});