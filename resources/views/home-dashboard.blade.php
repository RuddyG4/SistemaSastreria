<x-app>
    <x-slot:title>
        Bienvenida
        </x-slot>
        <div>
            <h1>
                <b>Sistema de administración de SASTRERÍA MAYA</b>
            </h1>
            <h2>Bienvenid@ <b>{{Auth::user()->username}}</b></h2>
        </div>
</x-app>