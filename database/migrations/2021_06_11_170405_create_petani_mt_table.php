<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaniMtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petani_mt', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('petani_id')->nullable();
            $table->foreign('petani_id')->references('id')->on('petani');
            $table->integer('qty')->default(0);
            $table->integer('qty_beli')->default(0);
            $table->string('produk', 10)->nullable();
            $table->integer('mt')->nullable();
            $table->integer('tahun')->default(2021);
            $table->string('type')->default('stock');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petani_mt');
    }
}
