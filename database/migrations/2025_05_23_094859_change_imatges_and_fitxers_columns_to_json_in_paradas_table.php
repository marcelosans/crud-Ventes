<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeImatgesAndFitxersColumnsToJsonInParadasTable extends Migration
{
    public function up()
    {
        Schema::table('paradas', function (Blueprint $table) {
            // Cambiar columnas a json
            $table->json('imatges')->nullable()->change();
            $table->json('fitxers_adjuntats')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('paradas', function (Blueprint $table) {
            // Revertir a text
            $table->text('imatges')->nullable()->change();
            $table->text('fitxers_adjuntats')->nullable()->change();
        });
    }
}
