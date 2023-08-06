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
        Schema::create('client_date', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned()->index()->comment = 'Identificador de la tabla cliente';
            $table->foreign('client_id')->references('id')->on('client');
            $table->date('date_entry');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_date');
    }
};
