<?php

use App\Http\Controllers\usuarios\FuncionalidadController;
use App\Http\Controllers\usuarios\RolController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/dashboard/funcionalidades', FuncionalidadController::class);
Route::resource('/dashboard/roles', RolController::class);
