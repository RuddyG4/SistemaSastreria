<?php

namespace Database\Factories;

use App\Models\servicios\Cliente;
use App\Models\usuarios\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'direccion' => fake()->streetAddress(),
        ];
    }
}
