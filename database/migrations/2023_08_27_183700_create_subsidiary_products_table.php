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
        Schema::table('product', function (Blueprint $table) {

            $table->dropColumn('unit_price');
            $table->dropColumn('sell_price');
            $table->dropColumn('amount');
        });
        Schema::create('subsidiary_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->index()->comment = 'Identificador de la tabla product';
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->bigInteger('subsidiary_id')->unsigned()->index()->comment = 'Identificador de la tabla subsidiary';
            $table->foreign('subsidiary_id')->references('id')->on('subsidiary')->onDelete('cascade');
            $table->double('unit_price');
            $table->double('sell_price');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsidiary_products');
        Schema::table('product', function (Blueprint $table) {
            $table->double('unit_price');
            $table->double('sell_price');
            $table->integer('amount');
        });
    }
};
