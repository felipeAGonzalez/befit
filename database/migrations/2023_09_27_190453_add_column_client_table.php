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
        Schema::table('client', function (Blueprint $table) {
            $table->bigInteger('subsidiary_id')->unsigned()->index()->after('id')->comment = 'Identificador de la tabla subsidiary';
            $table->foreign('subsidiary_id')->references('id')->on('subsidiary');
            $table->integer('phone_number')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropForeign(['subsidiary_id']);
            $table->dropColumn('subsidiary_id');
            $table->dropColumn('phone_number');
        });
    }
};
