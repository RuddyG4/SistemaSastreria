<?php

namespace Database\Seeders;

use App\Models\servicios\Cliente;
use App\Models\servicios\Telefono;
use App\Models\usuarios\Persona;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $personas = Persona::factory()
            ->count(800)
            ->hasCliente(1)
            ->create();

        foreach ($personas as $persona) {
            Telefono::factory()
                ->count(1)
                ->create(['id_cliente' => $persona->id]);
        }

        Persona::factory()
            ->count(80)
            ->hasUsuario(1)
            ->create();
    }
}
