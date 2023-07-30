<?php

namespace Database\Factories;

use App\Models\servicios\Cliente;
use App\Models\servicios\Telefono;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TelefonoFactory extends Factory
{
    protected $model = Telefono::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => fake()->unique()->numberBetween(60000000, 79999999),
            'tipo' => 0,
        ];
    }
}
