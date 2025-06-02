<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marxants', function (Blueprint $table) {
            // Si no existen estas columnas, las añadimos
            if (!Schema::hasColumn('marxants', 'imatges')) {
                $table->text('imatges')->nullable()->after('observacions');
            }
            
            if (!Schema::hasColumn('marxants', 'fitxers_adjuntats')) {
                $table->text('fitxers_adjuntats')->nullable()->after('imatges');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marxants', function (Blueprint $table) {
            $table->dropColumn(['imatges', 'fitxers_adjuntats']);
        });
    }
};