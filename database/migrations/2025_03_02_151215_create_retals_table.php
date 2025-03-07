<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TABLA RETALES
        Schema::create('retales', function (Blueprint $table) {
            $table->id();
            $table->enum('tejido', ['strech', 'popelin', 'jacquard', 'viscosa']);
            $table->enum('subcategoria', ['estampado', 'flocado', 'otros']);
            $table->enum('gama', [
                'amarillo', 'azul', 'blanco', 'gris', 'marrón', 'morado', 
                'naranja', 'negro', 'rojo', 'rosa', 'verde'
            ]);
            $table->string('color_primario');
            $table->string('color_secundario');
            $table->decimal('metros', 3, 2);
            $table->decimal('precio_base', 4, 2);
            $table->decimal('precio_retal', 4, 2);
            $table->enum('estado', ['disponible', 'vendido']);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // TABLA IMÁGENES DE RETALES
        Schema::create('retal_imagenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retal_id')->constrained('retales')->onDelete('cascade');
            $table->string('ruta_imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retal_imagenes');
        Schema::dropIfExists('retales');
    }
};
