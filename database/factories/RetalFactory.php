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
            'tejido'         => $this->faker->randomElement(Retal::TEJIDOS),
            'subcategoria'   => $this->faker->randomElement(Retal::SUBCATEGORIAS),
            'gama'           => $this->faker->randomElement(Retal::GAMAS),
            'color_primario'   => $this->faker->colorName(),
            'color_secundario' => $this->faker->colorName(),
            'metros'           => $this->faker->randomFloat(2, 0.1, 9.99),  // Mínimo 0.1, máximo 9.99
            'precio_base'      => $this->faker->randomFloat(2, 0.1, 99.99), // Mínimo 0.1, máximo 99.99
            'precio_retal'     => $this->faker->randomFloat(2, 0.1, 99.99), // Mínimo 0.1, máximo 99.99
            'estado'           => $this->faker->randomElement(Retal::ESTADOS),
            'descripcion'      => $this->faker->sentence(),
        ];
    }

    // Enum 'tejido'
    public function deTejidoStrech(): static
    {
        return $this->state([
            'tejido' => Retal::TEJIDO_STRECH
        ]);
    }

    public function deTejidoPopelin(): static
    {
        return $this->state([
            'tejido' => Retal::TEJIDO_POPELIN
        ]);
    }

    public function deTejidoJacquard(): static
    {
        return $this->state([
            'tejido' => Retal::TEJIDO_JACQUARD
        ]);
    }

    public function deTejidoViscosa(): static
    {
        return $this->state([
            'tejido' => Retal::TEJIDO_VISCOSA
        ]);
    }

    // Enum 'subcategoría'
    public function deSubcategoriaEstampado(): static
    {
        return $this->state([
            'subcategoria' => Retal::SUBCATEGORIA_ESTAMPADO
        ]);
    }

    public function deSubcategoriaFlocado(): static
    {
        return $this->state([
            'subcategoria' => Retal::SUBCATEGORIA_FLOCADO
        ]);
    }

    public function deSubcategoriaOtros(): static
    {
        return $this->state([
            'subcategoria' => Retal::SUBCATEGORIA_OTROS
        ]);
    }

    // Enum 'gama'
    public function deGamaAmarillo(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_AMARILLO
        ]);
    }

    public function deGamaAzul(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_AZUL
        ]);
    }

    public function deGamaBlanco(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_BLANCO
        ]);
    }

    public function deGamaGris(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_GRIS
        ]);
    }

    public function deGamaMarron(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_MARRON
        ]);
    }

    public function deGamaMorado(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_MORADO
        ]);
    }

    public function deGamaNaranja(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_NARANJA
        ]);
    }

    public function deGamaNegro(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_NEGRO
        ]);
    }

    public function deGamaRojo(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_ROJO
        ]);
    }

    public function deGamaRosa(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_ROSA
        ]);
    }

    public function deGamaVerde(): static
    {
        return $this->state([
            'gama' => Retal::GAMA_VERDE
        ]);
    }

    // Enum 'estado'
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
