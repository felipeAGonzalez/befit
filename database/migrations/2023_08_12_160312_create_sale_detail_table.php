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
        Schema::create('sale_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sale_id')->unsigned()->index()->comment = 'Identificador de la tabla sales';
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->bigInteger('product_id')->nullable()->unsigned()->index()->comment = 'Identificador de la tabla product';
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->bigInteger('service_id')->nullable()->unsigned()->index()->comment = 'Identificador de la tabla services';
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->integer('amount');
            $table->string('category');
            $table->string('description');
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_detail');
    }
};
