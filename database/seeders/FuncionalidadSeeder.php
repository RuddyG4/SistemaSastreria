<?php

namespace Database\Seeders;

use App\Models\usuarios\Funcionalidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuncionalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Funcionalidad::create([
            'nombre' => 'adm.usuario',
            'descripcion' => 'Permite controlar aspectos relacionados con los usuarios.',
        ]);

        Funcionalidad::create([
            'nombre' => 'adm.servicio',
            'descripcion' => 'Permite controlar aspectos relacionados con los servicios.',
        ]);
        Funcionalidad::create([
            'nombre' => 'adm.inventario',
            'descripcion' => 'Permite controlar aspectos relacionados con el inventario.',
        ]);

        Funcionalidad::create([
            'nombre' => 'adm.inventario',
            'descripcion' => 'Permite controlar aspectos relacionados con el inventario.',
        ]);
    }
}
