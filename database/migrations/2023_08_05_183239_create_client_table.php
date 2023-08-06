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
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('last_name_two');
            $table->string('email');
            $table->date('birth_date');
            $table->string('photo')->nullable();
            $table->unique(['name', 'last_name','email'], 'client_unique')->comment = 'Indice (unique) de los campos name y last_name, para que no existan tuplas duplicadas.';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
