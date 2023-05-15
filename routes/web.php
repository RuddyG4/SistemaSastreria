<?php

use App\Http\Controllers\usuarios\FuncionalidadController;
use App\Http\Controllers\usuarios\PersonaController;
use App\Http\Controllers\usuarios\LoginController;
use App\Http\Controllers\usuarios\RolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarios\UserController;

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    });
    Route::resource('/dashboard/funcionalidades', FuncionalidadController::class);
    Route::resource('/dashboard/roles', RolController::class);
    Route::resource('/dashboard/usuarios', UserController::class);
    Route::resource('/dashboard/personas', PersonaController::class);
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});