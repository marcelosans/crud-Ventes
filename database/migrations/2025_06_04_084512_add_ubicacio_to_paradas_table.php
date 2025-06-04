<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paradas', function (Blueprint $table) {
            $table->string('ubicacio', 150)->nullable()->after('estacionament');
        });
    }

    public function down(): void
    {
        Schema::table('paradas', function (Blueprint $table) {
            $table->dropColumn('ubicacio');
        });
    }

};
