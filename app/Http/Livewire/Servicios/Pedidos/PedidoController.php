<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\servicios\Pedido;
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
    public function show(Pedido $pedido)
    {
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
