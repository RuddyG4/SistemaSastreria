<?php

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
        return view('home-dashboard');
    });
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard/adm_usuarios/roles', App\Http\Livewire\usuarios\Roles::class);
    Route::get('/dashboard/adm_usuarios/funcionalidades', App\Http\Livewire\usuarios\Funcionalidades::class);
    Route::get('/dashboard/adm_usuarios/usuarios', App\Http\Livewire\usuarios\Usuarios::class);
    Route::get('/dashboard/adm_usuarios/bitacora', App\Http\Livewire\usuarios\Bitacora::class);
    Route::get('/dashboard/adm_servicios/clientes', App\Http\Livewire\Servicios\Clientes::class);
    Route::get('/dashboard/adm_servicios/vestimentas', App\Http\Livewire\Servicios\Vestimentas ::class);
    Route::get('/dashboard/adm_inventario/almacenes', App\Http\Livewire\Inventario\Almacenes::class);
    Route::get('/dashboard/adm_inventario/materiales', App\Http\Livewire\Inventario\Materiales::class);
    Route::get('/dashboard/adm_inventario/inventario', App\Http\Livewire\Inventario\Inventario::class);
    Route::get('/dashboard/adm_inventario/notas', App\Http\Livewire\Inventario\Notas::class);


});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});



