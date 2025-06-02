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
        Schema::create('paradas', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('marxant_id')->constrained('marxants')->cascadeOnDelete();
            $table->date('data_alta')->nullable();
            $table->date('data_last_renovation')->nullable();
            $table->enum('actiu', ['Si','No'])->default('Si');
            $table->string('tipus_parada')->nullable();
            $table->enum('is_comerc_local', ['Si','No'])->nullable();
            $table->string('sector');
            $table->string('activitat');
            $table->enum('formacio_alimentacio', ['Si','No'])->nullable();
            $table->decimal('metres_lineals', 10, 2);
            $table->decimal('metres_de_fons', 10, 2)->nullable();
            $table->enum('estacionament', ['Si','No'])->default('Si');
            $table->text('imatges')->nullable();
            $table->text('fitxers_adjuntats')->nullable();
            $table->longText('observacions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paradas');
    }
};
