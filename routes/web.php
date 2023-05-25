<?php

use App\Http\Controllers\usuarios\PersonaController;
use App\Http\Controllers\LoginController;
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
    return view('home');
});
    
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    });
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard/roles', App\Http\Livewire\Tabla::class);
    Route::get('/dashboard/funcionalidades', \App\Http\Livewire\usuarios\Funcionalidades::class);
    Route::get('/dashboard/usuarios', \App\Http\Livewire\usuarios\Usuarios::class);
    Route::resource('/dashboard/personas', PersonaController::class);
    
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});



