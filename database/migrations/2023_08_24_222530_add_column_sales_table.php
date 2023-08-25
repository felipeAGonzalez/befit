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
        Schema::table('sales', function (Blueprint $table) {
            $table->string('shift')->after('client_id');
            $table->bigInteger('subsidiary_id')->after('client_id')->unsigned()->index()->comment = 'Identificador de la tabla sucursal';
            $table->foreign('subsidiary_id')->references('id')->on('subsidiary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('shift');
            $table->dropForeign(['subsidiary_id']);
            $table->dropColumn('subsidiary_id');
        });
    }
};
