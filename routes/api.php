<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\AnimalsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//private routes
Route::middleware('auth:api')->group(function () {
    Route::get("/get-user", [testController::class, "userInfo"]);
    
    Route::get("/animals", [AnimalsController::class, "index"]);
    Route::post("/animals", [AnimalsController::class, "store"]);
    Route::get("/animals/{id}", [AnimalsController::class, "show"]);
    Route::put("/animals/{id}", [AnimalsController::class, "update"]);
    Route::delete("/animals/{id}", [AnimalsController::class, "destroy"]);
});

// user authentication
Route::post("/register", [testController::class, "register"]);
Route::post("/login", [testController::class, "login"]);
