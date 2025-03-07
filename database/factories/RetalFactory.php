<?php

namespace Database\Factories;

use App\Models\Retal;
use Illuminate\Database\Eloquent\Factories\Factory;

class RetalFactory extends Factory
{
    protected $model = Retal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tejido'         => $this->faker->randomElement(['strech', 'popelin', 'jacquard', 'viscosa']),
            'subcategoria'   => $this->faker->randomElement(['estampado', 'flocado', 'otros']),
            'gama'           => $this->faker->randomElement([
                'amarillo',
                'azul',
                'blanco',
                'gris',
                'marrón',
                'morado',
                'naranja',
                'negro',
                'rojo',
                'rosa',
                'verde'
            ]),
            'color_primario'   => $this->faker->colorName(),
            'color_secundario' => $this->faker->colorName(),
            'metros'           => $this->faker->randomFloat(2, 0.1, 9.99),  // Mínimo 0.1, máximo 9.99
            'precio_base'      => $this->faker->randomFloat(2, 0.1, 99.99), // Mínimo 0.1, máximo 99.99
            'precio_retal'     => $this->faker->randomFloat(2, 0.1, 99.99), // Mínimo 0.1, máximo 99.99
            'estado'           => $this->faker->randomElement(Retal::ESTADOS),
            'descripcion'      => $this->faker->sentence(),
        ];
    }

    /* ESTADOS */

    public function deEstadoDisponible(): static
    {
        return $this->state([
            'estado' => 'disponible'
        ]);
    }

    public function deEstadoVendido(): static
    {
        return $this->state([
            'estado' => 'vendido'
        ]);
    }
}
