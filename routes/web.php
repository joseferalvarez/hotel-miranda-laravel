<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [RoomController::class, "showIndex"]);
Route::get("about-us", function () {
    return view("about");
});
Route::get("rooms", [RoomController::class, "showGrid"]);
Route::get("rooms/{idroom}", [RoomController::class, "showDetails"]);
Route::get("offers", [RoomController::class, "showOffers"]);

Route::get("contact", [ContactController::class, "showContact"]);
Route::post("contact",[ContactController::class, "insertContact"]);
