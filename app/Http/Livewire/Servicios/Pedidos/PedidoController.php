<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\servicios\Cliente;
use App\Models\servicios\Pedido;
use App\Models\servicios\Telefono;
use App\Models\usuarios\Persona;
use App\Models\usuarios\User;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalPedidos = Pedido::count();
        $pedidosPendientes = Pedido::where('estado_avance', '<>', 1)->count();
        return view('livewire.servicios.pedidos.index', compact('totalPedidos', 'pedidosPendientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livewire.servicios.pedidos.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pedido = Pedido::addSelect(
            [
                'nombre_cliente' => Persona::select('nombre')->whereColumn('id_cliente', 'persona.id')->limit(1),
                'apellido_cliente' => Persona::select('apellido')->whereColumn('id_cliente', 'persona.id')->limit(1),
                'ci_cliente' => Persona::select('ci')->whereColumn('id_cliente', 'persona.id')->limit(1),
                'direccion_cliente' => Cliente::select('direccion')->whereColumn('id_cliente', 'cliente.id')->limit(1),
                'usuario' => User::select('username')->whereColumn('id_usuario', 'usuario.id')->limit(1),
                'numero_cliente' => Telefono::select('numero')->whereColumn('id_cliente', 'telefono.id_cliente')->limit(1),
            ]
        )
        ->with(['fechasPago' => function ($query) {
            $query->orderBy('fecha');
        }])
        ->withSum('detalles', 'cantidad')->find($id);
        return view('livewire.servicios.pedidos.ver-pedido', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
