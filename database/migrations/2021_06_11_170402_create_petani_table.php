<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petani', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('no')->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('nama', 80)->nullable();
            $table->string('rencana_tanam')->nullable();
            $table->string('kelompok', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'no',
                'nik',
                'nama',
                'kelompok',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petani');
    }
}
