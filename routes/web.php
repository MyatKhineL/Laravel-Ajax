<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('item/',[ItemController::class,'index']);
Route::get('item/all/',[ItemController::class,'allData']);
Route::post('item/store/',[ItemController::class,'storeData']);
Route::get('item/edit/{id}',[ItemController::class,'editData']);
Route::post('item/update/{id}',[ItemController::class,'updateData']);
Route::get('item/destroy/{id}',[ItemController::class,'destroyData']);
