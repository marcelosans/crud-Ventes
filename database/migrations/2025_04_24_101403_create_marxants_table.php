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
        Schema::create('marxants', function (Blueprint $table) {
            $table->id();
            $table->string("nom", 100);
            $table->string("nif", 15)->unique(); 
            $table->date("data_naixement");
            $table->string("telefon_fix", 20)->nullable();
            $table->string("telefon_mobil", 20)->nullable();
            $table->string("correu", 100)->unique()->nullable();
            $table->string("adreca", 150)->nullable(); 
            $table->string("codi_postal", 10)->nullable();
            $table->enum('regim_ss', ['Altres', 'Autònom', 'Cooperativista', 'No Consta'])->default('Altres');
            $table->string("asseguranca", 100)->nullable();
            // $table->foreignId('brand_id')->constrained('pagament')->cascadeOnDelete();
            $table->longText("observacions")->nullable();
            $table->json('imatges')->nullable(); 
            $table->json('fitxers_adjuntats')->nullable(); 
            $table->enum('dades_publiques', ['Si', 'No'])->default('Si');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marxants');
    }
};
