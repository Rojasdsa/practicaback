<?php

namespace Database\Factories;

use App\Models\Retal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RetalFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->text(8),
            'metros' => $this->faker->randomFloat(4,2),
            'precio' => $this->faker->randomFloat(4,2),
            'image' => $this->faker->imageUrl(),
        ];
    }

    /* ESTADOS */

    public function deEstadoDisponible(): static
    {
        return $this->state([
            "estado" => Retal::ESTADO_DISPONIBLE
        ]);
    }
    public function deEstadoVendido(): static
    {
        return $this->state([
            "estado" => Retal::ESTADO_VENDIDO
        ]);
    }
}
