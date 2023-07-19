@extends('layouts.copia')
 
@section('title', 'Page Title')
 
@section('content')
    <p>This is my body content.</p>
    <?php

use App\Models\usuarios\User;

    $usuarios = User::all();
    ?>
    <livewire:servicios.pedidos.vestimenta-pedido :users="$usuarios" />
    {{ $usuarios }}
@endsection