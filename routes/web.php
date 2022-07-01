<?php

use App\Http\Controllers\EquipmentController;
use Illuminate\Support\Facades\Route;
use App\Models\EquipmentType;

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

Route::get('/api/equipment-type', function () {
    $equipmentType = EquipmentType::all();

    return view('equipmentType.index', compact('equipmentType'));
});
