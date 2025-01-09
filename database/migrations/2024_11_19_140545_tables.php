<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Crear tabla categoria
        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('activo');
            $table->timestamps();
        });

        // Crear tabla estado
        Schema::create('estado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });

        // Crear tabla curso
        Schema::create('curso', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('categoria_id')->constrained('categoria');
            $table->string('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('estado_id')->default(1)->constrained('estado');
            $table->timestamps();
        });

        // Crear tabla pregunta
        Schema::create('pregunta', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->foreignId('curso_id')->constrained('curso');
        });

        // Crear tabla tipo_pregunta
        Schema::create('tipo_pregunta', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregunta');
        Schema::dropIfExists('curso');
        Schema::dropIfExists('estado');
        Schema::dropIfExists('categoria');
    }
}
