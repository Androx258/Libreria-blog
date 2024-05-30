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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_libro');
            $table->string('nombre_autor');
            $table->string('editorial');
            $table->string('genero_literario');
            $table->integer('ano_publicacion');
            $table->string('portada')->nullable();
            $table->string('desc_libro')->nullable();
            $table->unsignedBigInteger('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
