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
    return redirect()->to('/dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('home-dashboard');
    });
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Paquete de usuarios
    Route::prefix('/dashboard/adm_usuarios')->group(function () {
        Route::get('/roles', App\Http\Livewire\usuarios\Roles::class);
        Route::get('/funcionalidades', App\Http\Livewire\usuarios\Funcionalidades::class);
        Route::get('/usuarios', App\Http\Livewire\usuarios\Usuarios::class)->can('viewAny', App\Models\usuarios\User::class);
        Route::get('/bitacora', App\Http\Livewire\usuarios\Bitacora::class);
        Route::get('/perfil', function () {
            return view('livewire.usuarios.perfil');
        });
    });

    // Paquete de Servicios
    Route::prefix('/dashboard/adm_servicios')->group(function () {
        Route::get('/clientes', App\Http\Livewire\Servicios\Clientes::class);
        Route::get('/vestimentas', App\Http\Livewire\Servicios\Vestimentas::class);
        Route::get('/pedidos/{id}/asignar-vestimentas', App\Http\Livewire\Servicios\Pedidos\AsignarVestimentas::class);
        Route::resource('/pedidos', App\Http\Livewire\Servicios\Pedidos\PedidoController::class);
    });

    // Paquete de Inventario
    Route::prefix('/dashboard/adm_inventario')->group(function () {
        Route::get('/almacenes', App\Http\Livewire\Inventario\Almacenes::class);
        Route::get('/materiales', App\Http\Livewire\Inventario\Materiales::class);
        Route::get('/inventario', App\Http\Livewire\Inventario\Inventario::class);
        Route::get('/notas', App\Http\Livewire\Inventario\Notas::class);
    });

    // paquetes de reportes
    Route::get('/dashboard/adm_reporte/inventarios', App\Http\Livewire\Reportes\Inventarios::class);
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// Route::group(['prefix' => '/dashboard', 'middleware' => 'auth'], function () {
//     // Rutas...
// } );