<?php

use App\Http\Controllers\EquipmentController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EquipmentTypeController;

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

Route::resources([
    '/api/equipment' => EquipmentController::class
]);

Route::get('/api/equipment-type', [EquipmentTypeController::class]);

Route::get('/search', [EquipmentController::class, 'search'])->name('search');
