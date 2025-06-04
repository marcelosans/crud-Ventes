<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiuToMarxantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('marxants', function (Blueprint $table) {
            $table->enum('actiu', ['Si', 'No'])->default('Si')->after('dades_publiques');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marxants', function (Blueprint $table) {
            $table->dropColumn('actiu');
        });
    }
}
